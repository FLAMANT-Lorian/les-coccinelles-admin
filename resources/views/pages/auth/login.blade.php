@php
    use Illuminate\Support\Facades\Storage;
    $disk = config('filesystems.default');
@endphp

<x-layout.login-layout :title="__('page-title.login')">

    <main class="login">
        <div class="h-svh grid-login px-default max-limit-width">
            <div
                class="flex flex-col items-center justify-center h-full col-span-full md:col-start-2 md:col-span-4 rl:col-start-9 rl:col-span-4">
                <svg width="220" height="70" viewBox="0 0 220 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#logo"></use>
                </svg>
                <h1 class="text-2xl rg:text-3xl font-medium text-brown text-center pb-2 pt-6">{{ __('auth/login.h1') }}</h1>
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
                    srcset="{{ asset('assets/img/jpg/login/side-login-400w.webp') }} 400w,
                    {{ asset('assets/img/jpg/login/side-login-600w.webp') }} 600w, side-login-800w.webp 800w,
                    {{ asset('assets/img/jpg/login/side-login-1000w.webp') }} 1000w,
                    {{ asset('assets/img/jpg/login/side-login-1200w.webp') }} 1200w,
                    {{ asset('assets/img/jpg/login/side-login-1600w.webp') }} 1600w,
                    {{ asset('assets/img/jpg/login/side-login-2000w.webp') }} 2000w"
                    sizes="(max-width: 400px) 400px, (max-width: 600px) 600px, (max-width: 800px) 800px, (max-width: 1000px) 1000px, (max-width: 1200px) 1200px, (max-width: 1600px) 1600px, (min-width: 1601px) 2000px"
                    src="{{ asset('assets/img/jpg/login/side-login.jpg') }}"
                    alt="Photo du village de Morhet à travers les champs de blé"
                    width="2560"
                    height="1182"
                />
            </div>
        </div>
    </main>

</x-layout.login-layout>
