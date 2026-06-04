@php
    use Carbon\Carbon;
@endphp
<x-layout.mail-layout>

    <style>
        .main {
            padding: 2rem;
        }

        .title {
            font-size: 24px;
            color: #3D2B1F;
            margin: 0 0 12px;
        }

        .intro {
            margin: 0 0 2rem;
            font-size: 14px;
            color: #6c6d6e;
            line-height: 1.7;
        }

        .section-title {
            margin: 0 0 1rem;
            font-size: 16px;
            font-weight: 500;
            color: #3D2B1F;
        }

        .info {
            background-color: #f6f6f6;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            margin: 0 0 2rem;
            border: 1px solid #cfcfcf;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 32px;
            padding: 6px 0;
        }

        .info-divider {
            border-top: 1px solid #cfcfcf;
            margin: 4px 0;
        }

        .info-label {
            font-size: 14px;
            font-weight: 600;
            color: #6c6d6e;
        }

        .info-value {
            font-size: 14px;
            font-weight: 500;
            color: #57A770;
            text-align: right;
        }

        .notice {
            background-color: #F8D2C9;
            border-radius: 8px;
            padding: 1rem;
            font-size: 14px;
            line-height: 1.4;
            color: #C6390E;
        }
    </style>

    <main class="main">

        <h2 class="title">Votre réservation est confirmée</h2>

        <p class="intro">
            Bonjour {{ $booking->contact->first_name ?? 'cher client' }},<br>
            nous vous confirmons que votre réservation a bien été enregistrée.
            Vous trouverez ci-dessous le récapitulatif complet.
        </p>

        <section>
            <h2 class="section-title">Vos informations</h2>

            <div class="info">

                <div class="info-row">
                    <span class="info-label">Nom complet</span>
                    <span class="info-value">
                        {{ $booking->contact->full_name }}
                    </span>
                </div>

                <div class="info-divider"></div>

                <div class="info-row">
                    <span class="info-label">Adresse e-mail</span>
                    <span class="info-value">
                         {{ $booking->contact->email }}
                    </span>
                </div>

                <div class="info-divider"></div>

                <div class="info-row">
                    <span class="info-label">Téléphone</span>
                    <span class="info-value">
                         {{ $booking->contact->telephone }}
                    </span>
                </div>

            </div>
        </section>

        <section>
            <h2 class="section-title">Dates de la réservation</h2>

            <div class="info">

                <div class="info-row">
                    <span class="info-label">Date de début</span>
                    <span class="info-value">{{ formattedDate($booking->bookingDate->start_date) }}</span>
                </div>

                <div class="info-divider"></div>

                <div class="info-row">
                    <span class="info-label">Date de fin</span>
                    <span class="info-value">{{ formattedDate($booking->bookingDate->end_date) }}</span>
                </div>

                <div class="info-divider"></div>

                <div class="info-row">
                    <span class="info-label">Date de remise des clés</span>
                    <span class="info-value">
                        <span>{{ formattedDate($booking->bookingDate->key_handover_date) }}</span>
                        <span> à </span>
                        <span>{{ Carbon::parse($booking->bookingDate->key_handover_hour)->format('H:i') }}</span>
                    </span>
                </div>

                <div class="info-divider"></div>

                <div class="info-row">
                    <span class="info-label">Date de reprise des clés</span>
                    <span class="info-value">
                        <span>{{ formattedDate($booking->bookingDate->key_return_date) }}</span>
                        <span> à </span>
                        <span>{{ Carbon::parse($booking->bookingDate->key_return_hour)->format('H:i') }}</span>
                    </span>
                </div>

            </div>
        </section>

        <section>
            <h2 class="section-title">Détails de la réservation</h2>

            <div class="info">

                <div class="info-row">
                    <span class="info-label">Référence</span>
                    <span class="info-value">{{ $booking->uniqid }}</span>
                </div>

                <div class="info-divider"></div>

                <div class="info-row">
                    <span class="info-label">Type de réservation</span>
                    <span class="info-value">{{ $booking->hall_rate->type }}</span>
                </div>

                @if($booking->company_name)
                    <div class="info-divider"></div>

                    <div class="info-row">
                        <span class="info-label">Entreprise</span>
                        <span class="info-value">{{ $booking->company_name }}</span>
                    </div>
                @endif

                <div class="info-divider"></div>

                <div class="info-row">
                    <span class="info-label">Adresse de facturation</span>
                    <span class="info-value">{{ $booking->billing_address }}</span>
                </div>

            </div>
        </section>

        <div class="notice">
            <strong>Important :</strong> veuillez conserver cette confirmation pour vos documents.
        </div>

    </main>

</x-layout.mail-layout>
