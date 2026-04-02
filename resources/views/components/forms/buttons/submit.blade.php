@props([
    'label'
])

<button type="submit"
    {{ $attributes->merge(['class' => 'py-3 px-4 uppercase text-base font-normal rounded-sm outline outline-brown hover:bg-brown trans-all hover:text-white']) }}>
    {{ $label }}
</button>
