@props([
    'label'
])

<button type="submit"
    {{ $attributes->merge(['class' => 'text-brown py-3 px-4 text-base font-normal rounded-sm border border-brown hover:text-brown hover:bg-transparent bg-brown trans-all text-white']) }}>
    {{ $label }}
</button>
