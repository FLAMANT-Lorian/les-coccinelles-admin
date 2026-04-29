<?php

namespace App\Http\Controllers;

use App\Enums\MessageStatus;
use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PublicFormRequest extends Controller
{
    public function create(Request $request): RedirectResponse|JsonResponse|null
    {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'object' => 'required',
            'message' => 'required',
            'acceptance' => 'accepted',
            'type' => [Rule::enum(MessageTypes::class)]
        ]);

        $type = $request->all()['type'];

        if ($validator->fails()) {

            $data = [
                'success' => false,
                'errors' => $validator->errors(),
                'values' => $request->all()
            ];

            if ($request->expectsJson()) {
                return response()->json($data);
            }

            $token = base64_encode(json_encode($data));
            if ($type === MessageTypes::contact->value) {
                return redirect()->to(config('publicUrl.wordpress_contact_Url') . '?token=' . $token);
            } elseif ($type === MessageTypes::booking->value) {
                return redirect()->to(config('publicUrl.wordpress_booking_Url') . '?token=' . $token);
            }
        }


        $data = [
            'success' => true,
            'message' => 'Votre demande à été prise en compte, nous vous recontacterons dès que possible !'
        ];

        $this->createMessage($validator->validate());

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        $token = base64_encode(json_encode($data));


        if ($type === MessageTypes::contact->value) {
            return redirect()->to(config('publicUrl.wordpress_contact_Url') . '?success=true&token=' . $token);
        } elseif ($type === MessageTypes::booking->value) {
            return redirect()->to(config('publicUrl.wordpress_booking_Url') . '?success=true&token=' . $token);
        }

        return null;
    }

    private function createMessage(array $data): void
    {
        Message::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'subject' => $data['object'],
            'message' => $data['message'],
            'acceptance' => true,
            'status' => MessageStatus::Unread->value,
            'type' => $data['type']
        ]);
    }
}
