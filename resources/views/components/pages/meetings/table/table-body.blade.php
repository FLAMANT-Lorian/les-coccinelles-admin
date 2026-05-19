<tbody>
    @foreach($this->getMeetings as $meeting)
        <x-pages.meetings.table.tr :meeting="$meeting"/>
    @endforeach
</tbody>
