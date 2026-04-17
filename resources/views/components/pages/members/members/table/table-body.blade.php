<tbody>
    @foreach($this->getMembers as $member)
        <x-pages.members.members.table.tr :member="$member"/>
    @endforeach
</tbody>
