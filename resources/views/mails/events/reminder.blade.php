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
        }

        .message {
            background-color: #f6f6f6;
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid #cfcfcf;
            font-size: 14px;
            color: #3D2B1F;
            line-height: 1.7;
        }

        .btn {
            margin-top: 24px;
            display: flex;
            justify-content: center;
            background-color: #57A770;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
        }
    </style>

    <main class="main">

        <h2 class="title">Rappel : votre événement approche !</h2>

        <p class="intro">
            L'événement <strong>{{ $event->name }}</strong> aura lieu dans <strong>7 jours</strong>.
            Retrouvez ci-dessous toutes les informations utiles pour vous y préparer.
        </p>

        <section>
            <h2 class="section-title">Détails de l'événement</h2>
            <div class="info">
                <div class="info-row">
                    <span class="info-label">Événement</span>
                    <span class="info-value">{{ $event->name }}</span>
                </div>
                <div class="info-divider"></div>
                <div class="info-row">
                    <span class="info-label">Début</span>
                    <span class="info-value">
                        {{ formattedDate($event->start_date) }}
                    </span>
                </div>
                <div class="info-divider"></div>
                <div class="info-row">
                    <span class="info-label">Fin</span>
                    <span class="info-value">
                        {{ formattedDate($event->end_date) }}
                    </span>
                </div>
                <div class="info-divider"></div>
                <div class="info-row">
                    <span class="info-label">Adresse</span>
                    <span class="info-value">{{ $event->address }}</span>
                </div>
            </div>
        </section>

        @if($event->description)
            <section>
                <h2 class="section-title">Description</h2>
                <div class="message">{{ $event->description }}</div>
                <a class="btn"
                   aria-label="Voir l’événement"
                   href="{{ route('events.show', ['event' => $event->id]) }}">
                    Voir l’événement
                </a>
            </section>
        @endif

    </main>
</x-layout.mail-layout>
