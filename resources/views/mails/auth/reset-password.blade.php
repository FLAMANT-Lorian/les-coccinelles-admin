<x-layout.mail-layout>

    <p style="font-size:24px; color:#3D2B1F; font-weight:400; padding:0 0 12px; margin:0;">
        Réinitialisation de votre mot de passe
    </p>

    <p style="font-size:14px; color:#6c6d6e; line-height:1.7; padding:0 0 24px; margin:0;">
        Bonjour {{ $user->first_name ?? 'cher utilisateur' }},<br>
        nous avons reçu une demande de réinitialisation du mot de passe associé à votre compte.
        Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe.
    </p>

    <p style="font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px; margin:0;">
        Votre compte
    </p>

    <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf; margin-bottom:24px;">

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Adresse e-mail
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ $user->email }}
            </td>
        </tr>

    </table>

    <table style="width:100%; margin-bottom:24px;">
        <tr>
            <td style="text-align:center;">
                <a href="{{ $url }}"
                   style="display:inline-block; background:#57A770; color:#ffffff; text-decoration:none; font-size:16px; font-weight:600; padding:12px 32px;">
                    Réinitialiser mon mot de passe
                </a>
            </td>
        </tr>
    </table>

    <table style="width:100%; background:#F8D2C9; margin-bottom:24px;">
        <tr>
            <td style="padding:16px; font-size:14px; color:#C6390E; line-height:1.6;">
                <strong>Important :</strong> ce lien est valable <strong>60 minutes</strong>.
                Passé ce délai, vous devrez effectuer une nouvelle demande de réinitialisation.
            </td>
        </tr>
    </table>

    <p style="font-size:12px; color:#6c6d6e; line-height:1.7; margin:0 0 24px;">
        Si le bouton ne fonctionne pas, copiez et collez le lien suivant dans votre navigateur :
        <br>
        <a href="{{ $url }}" style="color:#57A770; word-break:break-all;">
            {{ $url }}
        </a>
    </p>

    <p style="font-size:12px; color:#6c6d6e; line-height:1.7; margin:0;">
        Si vous n'êtes pas à l'origine de cette demande, ignorez simplement cet e-mail.
        Votre mot de passe restera inchangé.
    </p>

</x-layout.mail-layout>
