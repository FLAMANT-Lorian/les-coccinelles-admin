@php
    use Illuminate\Support\Facades\Storage;
    $disk = config('filesystems.default');
@endphp

<x-layout.login-layout :title="__('page-title.forgot-password')">

    <main class="login">
        <div class="h-svh grid-login px-default max-limit-width">
            <div
                class="flex flex-col items-center justify-center h-full col-span-full md:col-start-2 md:col-span-4 rl:col-start-9 rl:col-span-4">
                <svg width="220" height="70" viewBox="0 0 220 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#logo"></use>
                </svg>
                <h1 class="text-2xl rg:text-3xl font-medium text-brown text-center pb-2">{{ __('auth/forgot-password.h1') }}</h1>
                <p class="paragraph text-gray-600 text-center mb-6">
                    {!! __('auth/forgot-password.forgot-password-accessibility')  !!}
                </p>

                {{-- FORMULAIRE --}}
                <x-pages.auth.forgot-password-form
                    class="w-full"/>

                <a wire:navigate
                    title="{{ __('auth/login.back_to_login') }}"
                   aria-label="{{ __('auth/login.back_to_login') }}"
                   class="underline-link after:bg-brown cursor-pointer trans-all flex flex-row gap-2 items-center mt-6"
                   href="{{ route('login', ['locale' => app()->getLocale()]) }}">
                    <svg width="17" height="8" viewBox="0 0 17 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.146447 3.32833C-0.0488153 3.52359 -0.0488153 3.84018 0.146447 4.03544L3.32843 7.21742C3.52369 7.41268 3.84027 7.41268 4.03553 7.21742C4.2308 7.02216 4.2308 6.70557 4.03553 6.51031L1.20711 3.68189L4.03553 0.853458C4.2308 0.658196 4.2308 0.341613 4.03553 0.146351C3.84027 -0.0489109 3.52369 -0.0489109 3.32843 0.146351L0.146447 3.32833ZM16.5 3.68189V3.18189H0.5L0.5 3.68189L0.5 4.18189H16.5V3.68189Z"
                            fill="#292A2B"/>
                    </svg>
                    {{ __('auth/login.back_to_login') }}
                </a>
            </div>
            <div class="relative max-rl:hidden rl:col-start-1 rl:col-span-7 rl:row-start-1">
                <img
                    class="h-full object-cover absolute min-w-[calc(100%+48px)] 2k:min-w-[calc(100%+48px+((100vw-2000px)/2))] right-0"
                    src="{{ asset('assets/img/jpg/side-login.jpg') }}"
                    alt="{{ __('auth/reset-password.alt') }}">
            </div>
        </div>
    </main>

</x-layout.login-layout>
