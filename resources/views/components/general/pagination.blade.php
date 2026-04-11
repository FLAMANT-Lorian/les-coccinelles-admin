@props([
    'items',
])

<div class="mt-8 lg:mt-6 self-end">
    {{ $items->onEachSide(1)->links(data: ['scrollTo' => false]) }}
</div>
