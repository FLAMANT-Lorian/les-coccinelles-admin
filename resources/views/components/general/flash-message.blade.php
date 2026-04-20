@if (session('success'))
    <div
        class="flash-message fixed flex flex-row items-center gap-4 p-4 bottom-8 right-8 z-50 border-l-4 border-l-green text-brown bg-beige-light rounded-sm shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
        <svg class="text-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21.801 10A10 10 0 1 1 17 3.335"/>
            <path d="m9 11 3 3L22 4"/>
        </svg>
        <span class="text-green">{{ session('success') }}</span>
    </div>
@endif
