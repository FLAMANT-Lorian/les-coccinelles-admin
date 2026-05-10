<?php

namespace App\Livewire\Forms;

use App\Enums\YesOrNo;
use App\Models\Contact;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ContactsForm extends Form
{
    public ?Contact $contact = null;

    public ?string $last_name = null;
    public ?string $first_name = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $member_card = null;
    public ?string $address = null;

    public function rules(): array
    {
        return [
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'required',
            'member_card' => ['required', Rule::enum(YesOrNo::class)],
            'address' => 'required',
        ];
    }

    public function update(): void
    {
        //
    }

    public function save(): void
    {
        Contact::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'telephone' => $this->phone,
            'member_card' => YesOrNo::from($this->member_card)->toBoolean(),
            'address' => $this->address,
        ]);
    }
}
