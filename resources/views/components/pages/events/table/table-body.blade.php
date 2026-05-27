<tbody>
    @foreach($this->getEvents as $event)
        <x-pages.events.table.tr :event="$event"/>
    @endforeach
</tbody>
