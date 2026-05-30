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

        .link {
            color: #57A770;
            font-weight: 600;
            text-decoration: none;
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

        <h2 class="title">Nouvelle demande de disponiblité</h2>

        <p class="intro">
            Un visiteur vient de soumettre une demande de disponibilité via le site.
            Vous trouverez ci-dessous les détails de sa demande.
        </p>

        <section>
            <h2 class="section-title">Informations de l'expéditeur</h2>
            <div class="info">
                <div class="info-row">
                    <span class="info-label">Nom</span>
                    <span class="info-value">{{ $availability_request->last_name . $availability_request->last_name }}</span>
                </div>
                <div class="info-divider"></div>
                <div class="info-row">
                    <span class="info-label">Adresse e-mail</span>
                    <span class="info-value">
                        <a class="link" href="mailto:{{ $availability_request->email }}">{{ $availability_request->email }}</a>
                    </span>
                </div>
                @if ($availability_request->phone)
                    <div class="info-divider"></div>
                    <div class="info-row">
                        <span class="info-label">Téléphone</span>
                        <span class="info-value">{{ $availability_request->phone }}</span>
                    </div>
                @endif
                <div class="info-divider"></div>
                <div class="info-row">
                    <span class="info-label">Reçu le</span>
                    <span class="info-value">{{ formattedDate($availability_request->created_at) }}</span>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title">Message</h2>
            <div class="message">{{ $availability_request->message }}</div>
            <a class="btn"
               aria-label="Voir le message dans l'administration"
               href="{{{ route('availabilities', ['term' => slugify($availability_request->first_name) . ' ' . slugify($availability_request->last_name)]) }}}">
                Voir la demande dans l'administration
            </a>
        </section>

    </main>
</x-layout.mail-layout>
