@props([
    'label',
    'name',
    'required' => false,
    'field_name'
])

<div x-data="{showPassword : false}" {{ $attributes->merge(['class' => 'relative field']) }}>
    <label for="{{ $field_name }}">
        {{ $label }}
        @if($required)
            <strong> *</strong>
        @endif
    </label>
    <input id="{{ $field_name }}"
           :type="showPassword ? 'text' : 'password'"
           type="password"
           name="{{ $name }}"
           autocomplete="off">

    @error($name)
    <p class="absolute -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
    @enderror

    <svg @click="showPassword = !showPassword" :class="showPassword ? 'hidden' : 'block'"
         class="hover:cursor-pointer absolute right-4 bottom-3"
         width="24"
         height="24" viewBox="0 0 24 24" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M20.3999 19.5L5.3999 4.5M10.1999 10.4416C9.82648 10.8533 9.5999 11.394 9.5999 11.9863C9.5999 13.2761 10.6744 14.3217 11.9999 14.3217C12.611 14.3217 13.1688 14.0994 13.5926 13.7334M20.4387 14.3217C21.2649 13.0848 21.5999 12.0761 21.5999 12.0761C21.5999 12.0761 19.4153 5.1 11.9999 5.1C11.5836 5.1 11.1838 5.12199 10.7999 5.16349M17.3999 17.3494C16.0225 18.2281 14.2492 18.8495 11.9999 18.8127C4.67683 18.693 2.3999 12.0761 2.3999 12.0761C2.3999 12.0761 3.45776 8.69808 6.5999 6.64332"
            stroke="#3D2B1F" stroke-width="1" stroke-linecap="round"/>
    </svg>

    <svg @click="showPassword = !showPassword" :class="showPassword ? 'block' : 'hidden'"
         class="hover:cursor-pointer absolute right-4 bottom-3"
         width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
            stroke="#3D2B1F" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
        <path
            d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
            stroke="#3D2B1F" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</div>
