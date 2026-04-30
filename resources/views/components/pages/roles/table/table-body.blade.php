<tbody>
    @foreach($this->getRoles as $role)
        <x-pages.roles.table.tr :role="$role"/>
    @endforeach
</tbody>
