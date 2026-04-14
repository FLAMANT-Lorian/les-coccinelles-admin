<tbody>
    @foreach($this->getMembersRole as $role)
        <x-pages.members.role.tr :role="$role"/>
    @endforeach
</tbody>
