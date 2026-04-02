@php
    use Illuminate\Support\Facades\Storage;
    $disk = config('filesystems.default');
@endphp

<x-layout.login-layout>

    <main class="login">
        <div class="h-svh grid-login px-auth max-limit-width">
            <div
                class="flex flex-col items-center justify-center h-full col-span-full md:col-start-2 md:col-span-4 rl:col-start-9 rl:col-span-4">
                <img class="w-55 mb-6"
                     src="{{ Storage::disk($disk)->url('img/svg/logo.svg') }}"
                     alt="{{ __('auth/login/logo-alt') }}">
                <h1 class="text-2xl font-medium text-brown text-center pb-2">{{ __('auth/login.h1') }}</h1>
                <p class="paragraph text-gray-600 text-center mb-6">
                    {!! __('forms.accessibility_text')  !!}
                </p>

                {{-- FORMULAIRE --}}
                <x-pages.auth.login-form
                    class="w-full"/>
            </div>
            <div class="relative max-rl:hidden rl:col-start-1 rl:col-span-7 rl:row-start-1">
                <img
                    class="h-full object-cover absolute min-w-[calc(100%+48px)] 2k:min-w-[calc(100%+48px+((100vw-2000px)/2))] right-0"
                    src="{{ Storage::disk($disk)->url('img/jpg/side-login.jpg') }}"
                    alt="{{ __('auth/login/side-img-alt') }}">
            </div>
        </div>
    </main>

</x-layout.login-layout>
