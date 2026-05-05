<tbody>
    @foreach($this->getHallRates as $hallRate)
        <x-pages.hall-rates.table.tr :hallRate="$hallRate"/>
    @endforeach
</tbody>
