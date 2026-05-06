<tbody>
    @foreach($this->getUtilityCosts as $utilityCost)
        <x-pages.utility-costs.table.tr :utilityCost="$utilityCost"/>
    @endforeach
</tbody>
