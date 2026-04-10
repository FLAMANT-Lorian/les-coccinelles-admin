@props([
    'bookingMessage' => Message::class,
])

<tr>
    <td>
        <div class="h-14">
            <input type="checkbox" id="all-selector">
            <label for="all-selector" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            {{ $bookingMessage->full_name }}
        </div>
    </td>
    <td>
        <div>
            {{ $bookingMessage->email }}
        </div>
    </td>
    <td>
        <div>
            {{ formattedDate($bookingMessage->created_at) }}
        </div>
    </td>
    <td>
        <div>
            {{ __('tables.status') }}
        </div>
    </td>
    <td data-action>
        <div>
            {{ __('tables.actions') }}
        </div>
    </td>
</tr>
