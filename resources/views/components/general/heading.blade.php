@props([
    'heading' => [],
])

<div class="flex flex-col gap-1 pb-8 lg:pb-6">
    <h1 class="text-brown text-3xl rg:text-4.5xl font-semibold">
        {{ $heading['title'] }}
    </h1>
    <p class="paragraph text-gray-500">{!! $heading['subtitle'] !!}</p>
</div>
