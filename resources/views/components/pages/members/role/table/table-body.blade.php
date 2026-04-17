<tbody>
    @foreach($this->getRoles as $role)
        <x-pages.members.role.table.tr :role="$role"/>
    @endforeach
</tbody>
