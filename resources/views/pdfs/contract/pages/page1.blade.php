@php
    use App\Models\Booking;
    use App\ValueObjects\Money;
    use Carbon\Carbon;
    /**
     * @var Booking $booking
     */
@endphp

<h1>
    Contrat de location<br>
    <strong>"Salle Des Coccinelles"</strong>
</h1>

<section>
    <h2 class="title">Informations du locataire</h2>

    <div class="row">Nom complet : <strong>{{ $booking->contact->full_name }}</strong></div>
    <div class="row">Email : <strong>{{ $booking->contact->email }}</strong></div>
    <div class="row">Téléphone : <strong>{{ $booking->contact->telephone }}</strong></div>
    <div class="row">Adresse : <strong>{{ $booking->contact->address }}</strong></div>

    @if($booking->company_name)
        <div class="row">Agissant au nom de <strong>{{ $booking->company_name }}</strong></div>
    @endif
</section>

<section>
    <h2 class="title">Détails de la réservation</h2>

    <div class="row">
        La réservation de la salle est prévue du
        <strong>{{ formattedDate($booking->bookingDate->start_date) }}</strong>
        au
        <strong>{{ formattedDate($booking->bookingDate->end_date) }}</strong>
    </div>

    <div class="row">
        La remise des clés se fera le
        <strong>{{ formattedDate($booking->bookingDate->key_handover_date) }}</strong>
        à
        <strong>{{ Carbon::parse($booking->bookingDate->key_handover_hour)->format('H\hi') }}</strong>
    </div>

    <div class="row">
        La restitution des clés se fera le
        <strong>{{ formattedDate($booking->bookingDate->key_return_date) }}</strong>
        à
        <strong>{{ Carbon::parse($booking->bookingDate->key_return_hour)->format('H\hi') }}</strong>
    </div>

    <div class="row">
        Type de réservation :
        <strong>{{ $booking->hall_rate->type }}</strong>
    </div>
</section>

<section>
    <h2 class="title">Tarification</h2>

    <div class="row">
        Montant de la caution :
        <strong>{{ Money::fromCents($booking->hall_rate->deposit)->euros() }} €</strong>
        (Restituée à la réception des clés moins les charges)
    </div>

    <div class="row">
        Prix de base :
        <strong>
            {{ Money::fromCents(
                    $booking->contact->member_card
                        ? $booking->hall_rate->member_price
                        : $booking->hall_rate->base_price
                )->euros()
            }} €
        </strong>
    </div>

    <div class="row">
        Acompte déjà payé :
        <strong>{{ Money::fromCents($booking->prepayment ?? 0)->euros() }} €</strong>
    </div>

    @php
        $base_price = Money::fromCents(
            $booking->contact->member_card
                ? $booking->hall_rate->member_price
                : $booking->hall_rate->base_price
        );

        $prepayment = Money::fromCents($booking->prepayment ?? 0);

        $remaining = $base_price < $prepayment ? 0 : $base_price->subtract($prepayment)->euros();
    @endphp

    <div class="row">
        Solde restant :
        <strong>{{ $remaining }} €</strong>
    </div>
</section>
