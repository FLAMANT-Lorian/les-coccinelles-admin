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
            margin: 0 0 1.5rem;
            font-size: 14px;
            color: #6c6d6e;
            line-height: 1.7;
        }

        .credentials {
            background-color: #f6f6f6;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            margin: 0 0 2rem;
            border: 1px solid #cfcfcf;
        }

        .credential-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
        }

        .credential-divider {
            border-top: 1px solid #cfcfcf;
            margin: 4px 0;
        }

        .credential-label {
            font-size: 14px;
            font-weight: 600;
            color: #6c6d6e;
        }

        .credential-value {
            font-size: 14px;
            font-weight: 500;
            color: #57A770;
        }

        .section-title {
            margin: 0 0 1rem;
            font-size: 16px;
            font-weight: 500;
            color: #3D2B1F;
        }

        .steps {
            width: 100%;
            margin: 0 0 2rem;
            display: flex;

            flex-direction: column;
            gap: 10px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-direction: row;
        }

        .number {
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 24px;
            height: 24px;
            background-color: #57A770;
            color: white;
            border-radius: 100%;
        }

        .text {
            font-size: 14px;
            color: #6c6d6e;
            margin: 0;
        }

        .link {
            color: #57A770;
            font-weight: 600;
            text-decoration: none;
        }

        .notice {
            background-color: #F8D2C9;
            border-radius: 8px;
            padding: 1rem;
            font-size: 14px;
            line-height: 1.7;
            color: #C6390E;
            margin: 0 0 2rem;
        }

        .divider {
            border-top: 1px solid #cfcfcf;
            margin: 0 0 2rem;
        }
    </style>
    <main class="main">
        <div>
            <h2 class="title">Bienvenue dans notre Asbl !</h2>

            <p class="intro">
                Votre compte a bien été créé. Vous trouverez ci-dessous vos identifiants pour accéder à l'interface
                d'administration.
            </p>
        </div>

        <section>
            <h2 class="sr-only">Identifiants</h2>
            <div class="credentials">
                <div class="credential-row">
                    <span class="credential-label">Adresse e-mail</span>
                    <span class="credential-value">{{ $user->email }}</span>
                </div>
                <div class="credential-divider"></div>
                <div class="credential-row">
                    <span class="credential-label">Mot de passe</span>
                    <span class="credential-value">{{ $old_password }}</span>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title">Comment me connecter ?</h2>

            <div class="steps">
                <div class="step">
                    <span class="number">1</span>
                    <p class="text">
                        Rendez-vous sur la
                        <a class="link"
                           href="{{ route('login', ['locale' => app()->getLocale()]) }}">
                            page de connexion
                        </a>
                    </p>
                </div>
                <div class="step">
                    <span class="number">2</span>
                    <p class="text">
                        Entrez vos identifiants dans le formulaire de connexion
                    </p>
                </div>
                <div class="step">
                    <span class="number">3</span>
                    <p class="text">
                        Vous avez accès à l'interface d'administration de l'asbl
                    </p>
                </div>
            </div>
            <div class="notice">
                <strong>Conseil :</strong> une fois connecté·e, modifiez votre mot de passe dès que possible depuis vos
                paramètres (en bas du menu).
            </div>
        </section>

        <div class="divider"></div>

        <section>
            <h2 class="section-title">Comment changer mon mot de passe ?</h2>

            <div class="steps">
                <div class="step">
                    <span class="number">1</span>
                    <p class="text">
                        Dans l'interface, rendez-vous dans vos <strong>paramètres</strong> (en bas du menu)
                    </p>
                </div>
                <div class="step">
                    <span class="number">2</span>
                    <p class="text">
                        Remplissez le formulaire de modification du mot de passe
                    </p>
                </div>
            </div>
        </section>
    </main>
</x-layout.mail-layout>
