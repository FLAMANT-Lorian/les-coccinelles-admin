<tbody>
    @foreach($this->getInterventions as $intervention)
        <x-pages.interventions.table.tr :intervention="$intervention"/>
    @endforeach
</tbody>
