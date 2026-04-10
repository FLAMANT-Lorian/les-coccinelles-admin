@props([
    'contactMessage' => Message::class,
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
            {{ $contactMessage->full_name }}
        </div>
    </td>
    <td>
        <div>
            {{ $contactMessage->email }}
        </div>
    </td>
    <td>
        <div>
            {{ formattedDate($contactMessage->created_at) }}
        </div>
    </td>
    <td>
        <div>
            <x-general.status :status="$contactMessage->status"/>
        </div>
    </td>
    <td data-action>
        <div>
            {{ __('tables.actions') }}
        </div>
    </td>
</tr>
