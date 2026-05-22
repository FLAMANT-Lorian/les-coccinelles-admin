<div>
    <table class="header-table">
        <tr>
            <td class="company">
                <h1>Facture</h1>

                <div style="margin-top: 20px;">
                    <strong>ASBL Les Coccinelles</strong><br/>
                    <span>57 Promenade des coccinelles Morhet,</span><br/>
                    <span>6640 Vaux-sur-Sûre</span><br/>
                </div>
            </td>

            <td class="text-right">
                    <span>
                        <strong>Réservation :</strong>
                        <span>
                            {{ formattedDate($booking->bookingDate->start_date) . ' au ' . formattedDate($booking->bookingDate->end_date) }}
                        </span>
                    </span>
            </td>
        </tr>
    </table>
</div>

<div class="section">
    <h2 style="margin-top: 12px; margin-bottom: 0">Locataire</h2>

    <div>
        <span><strong>Nom complet : </strong>{{ $booking->contact->full_name }}</span><br/>
        <span><strong>Adresse e-mail : </strong>{{ $booking->contact->email }}</span><br/>
        <span><strong>Téléphone : </strong>{{ $booking->contact->telephone }}</span><br/>
        <span><strong>Adresse de facturation : </strong>{{ $booking->billing_address }}</span>
    </div>
</div>

<div class="section">
    <h2 style="margin-top: 32px;">Détail des charges</h2>

    <table class="invoice-table">
        <thead>
            <tr>
                <th class="text-left">Type</th>
                <th class="text-center">Arrivé</th>
                <th class="text-center">Départ</th>
                <th class="text-center">Différence</th>
                <th class="text-center">Prix</th>
                <th class="text-right">Montant</th>
            </tr>
        </thead>

        <tbody>
            @foreach($utility_costs as $data)
                <tr>
                    <td>{{ $data['label'] }}</td>
                    <td class="text-center">{{ $data['before'] }}</td>
                    <td class="text-center">{{ $data['after'] }}</td>
                    <td class="text-center">{{ $data['diff'] }}</td>
                    <td class="text-center">{{ $data['cost'] }}</td>
                    <td class="text-right">{{ $data['total'] }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="section" style="margin-top: 32px">
    <div class="card">
        <h2>Résumé</h2>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th class="text-left">Détail</th>
                    <th class="text-right">Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice as $data)
                    <tr>
                        <td>{{ $data['label'] }}</td>
                        <td class="text-right">{{ $data['cost'] }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

