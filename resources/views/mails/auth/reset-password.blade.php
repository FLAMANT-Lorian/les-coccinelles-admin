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
            margin-bottom: 2rem;
        }

        .btn-wrapper {
            text-align: center;
            margin: 2rem 0;
        }

        .btn {
            display: inline-block;
            background-color: #57A770;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 8px;
        }

        .fallback {
            margin: 0 0 2rem;
            font-size: 12px;
            color: #6c6d6e;
            line-height: 1.7;
            word-break: break-all;
        }

        .fallback a {
            color: #57A770;
        }
    </style>

    <main class="main">

        <h2 class="title">Réinitialisation de votre mot de passe</h2>

        <p class="intro">
            Bonjour {{ $user->first_name ?? 'cher utilisateur' }},<br>
            nous avons reçu une demande de réinitialisation du mot de passe associé à votre compte.
            Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe.
        </p>

        <section>
            <h2 class="section-title">Votre compte</h2>

            <div class="info">
                <div class="info-row">
                    <span class="info-label">Adresse e-mail</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
            </div>
        </section>

        <div class="btn-wrapper">
            <a href="{{ $url }}" class="btn">Réinitialiser mon mot de passe</a>
        </div>

        <div class="notice">
            <strong>Important :</strong> ce lien est valable <strong>60 minutes</strong>.
            Passé ce délai, vous devrez effectuer une nouvelle demande de réinitialisation.
        </div>

        <p class="fallback">
            Si le bouton ne fonctionne pas, copiez et collez le lien suivant dans votre navigateur :<br>
            <a href="{{ $url }}">{{ $url }}</a>
        </p>

        <p class="fallback">
            Si vous n'êtes pas à l'origine de cette demande, ignorez simplement cet e-mail.
            Votre mot de passe restera inchangé.
        </p>

    </main>

</x-layout.mail-layout>
