<x-layout.mail-layout>
    <table style="width:100%;">
        <tr>
            <td style="font-size:24px; color:#3D2B1F; font-weight:400; padding:0 0 12px;">
                Bienvenue dans notre Asbl !
            </td>
        </tr>
    </table>

    <p style="font-size:14px; color:#6c6d6e; line-height:1.7; padding:0 0 20px; margin: 0">
        Votre compte a bien été créé. Vous trouverez ci-dessous vos identifiants pour accéder à l'interface
        d'administration.
    </p>

    <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf; margin-bottom: 24px; ">

        <tr>
            <td style="text-align: left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Adresse e-mail
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ $user->email }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align: left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Mot de passe
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ $old_password }}
            </td>
        </tr>
    </table>

    <table style="width:100%; margin-bottom: 24px;">
        <tr>
            <td colspan="2" style="text-align:left; font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px;">
                Comment me connecter ?
            </td>
        </tr>

        <tr>
            <td style="width:30px; vertical-align:top; padding:0 0 10px;">
                <div
                    style="width:24px; height:24px; background:#57A770; color:#ffffff; border-radius:50%; text-align:center; line-height:24px; font-size:12px;">
                    1
                </div>
            </td>
            <td style="text-align:left; font-size:14px; color:#6c6d6e; padding:0 0 10px;">
                Rendez-vous sur la
                <a href="{{ route('login', ['locale' => app()->getLocale()]) }}"
                   style="color:#57A770; font-weight:600; text-decoration:none;">
                    page de connexion
                </a>
            </td>
        </tr>

        <tr>
            <td style="width:30px; vertical-align:top; padding:0 0 10px;">
                <div
                    style="width:24px; height:24px; background:#57A770; color:#ffffff; border-radius:50%; text-align:center; line-height:24px; font-size:12px;">
                    2
                </div>
            </td>
            <td style="text-align:left; font-size:14px; color:#6c6d6e; padding:0 0 10px;">
                Entrez vos identifiants dans le formulaire de connexion
            </td>
        </tr>

        <tr>
            <td style="width:30px; vertical-align:top;">
                <div
                    style="width:24px; height:24px; background:#57A770; color:#ffffff; border-radius:50%; text-align:center; line-height:24px; font-size:12px;">
                    3
                </div>
            </td>
            <td style="text-align:left; font-size:14px; color:#6c6d6e;">
                Accédez à l’interface d’administration
            </td>
        </tr>
    </table>

    <table style="width:100%; background:#F8D2C9; margin-bottom: 24px;">
        <tr style="margin-bottom: 24px">
            <td style="padding:16px; font-size:14px; color:#C6390E; line-height:1.6; border-radius: 24px;">
                <strong>Conseil :</strong> changez votre mot de passe dès la première connexion.
            </td>
        </tr>
    </table>

    <table style="width:100%;">
        <tr>
            <td colspan="2" style="text-align:left; font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px;">
                Comment changer mon mot de passe ?
            </td>
        </tr>
        <tr>
            <td style="width:30px; vertical-align:top; padding:0 0 10px;">
                <div
                    style="width:24px; height:24px; background:#57A770; color:#ffffff; border-radius:50%; text-align:center; line-height:24px; font-size:12px;">
                    1
                </div>
            </td>
            <td style="text-align:left; font-size:14px; color:#6c6d6e; padding:0 0 10px;">
                Dans l'interface, ouvrez vos <strong>paramètres</strong>
            </td>
        </tr>
        <tr>
            <td style="width:30px; vertical-align:top;">
                <div
                    style="width:24px; height:24px; background:#57A770; color:#ffffff; border-radius:50%; text-align:center; line-height:24px; font-size:12px;">
                    2
                </div>
            </td>
            <td style="text-align:left; font-size:14px; color:#6c6d6e;">
                Modifiez votre mot de passe
            </td>
        </tr>
    </table>
</x-layout.mail-layout>
