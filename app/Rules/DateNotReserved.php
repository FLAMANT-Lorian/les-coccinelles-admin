<?php

namespace App\Rules;

use App\Models\Booking;
use App\Models\BookingDate;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Builder;

readonly class DateNotReserved implements ValidationRule
{

    public function __construct(private ?Booking $booking = null)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $separator = __('general.date-picker-format');

        if (str_contains($value, $separator)) {
            [$start, $end] = explode($separator, $value);
        } else {
            $start = $value;
            $end = $value;
        }

        $startDate = Carbon::parse($start)->startOfDay();
        $endDate = Carbon::parse($end)->endOfDay();

        $query = BookingDate::where(function ($q) use ($startDate, $endDate) {
            // CAS 1 – Le début de la nouvelle réservation commence dans une réservation existante
            $q->whereBetween('start_date', [$startDate, $endDate])

                // CAS 2 – La fin de la nouvelle réservation se termine dans une réservation existante
                ->orWhereBetween('end_date', [$startDate, $endDate])

                // CAS 3 – La nouvelle réservation se trouve au milieu d’une réservation existante
                ->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
                });
        });

        if ($this->booking) {
            $query->whereHas('booking', function (Builder $q) {
                $q->whereNot('id', $this->booking->id);
            });
        }

        if ($query->exists()) {
            $fail(__('forms.dates-are-already-booked'));
        }
    }
}
