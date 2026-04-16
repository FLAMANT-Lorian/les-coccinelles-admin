<tbody>
    @foreach($this->getMembersRole as $role)
        <x-pages.members.role.table.tr :role="$role"/>
    @endforeach
</tbody>
