<x-layout.mail-layout>

    <p style="font-size:24px; color:#3D2B1F; font-weight:400; padding:0 0 12px; margin:0;">
        Nouveau message de contact
    </p>

    <p style="font-size:14px; color:#6c6d6e; line-height:1.7; padding:0 0 24px; margin:0;">
        Un visiteur vient d'envoyer un message via le formulaire de contact du site.
        Vous trouverez ci-dessous les informations transmises.
    </p>

    <p style="font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px; margin:0;">
        Informations de l'expéditeur
    </p>

    <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf; margin-bottom:24px;">

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Nom
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ $contact_message->first_name . ' ' . $contact_message->last_name }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Adresse e-mail
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; text-align:right;">
                <a href="mailto:{{ $contact_message->email }}"
                   style="color:#57A770; text-decoration:none;">
                    {{ $contact_message->email }}
                </a>
            </td>
        </tr>

        @if ($contact_message->phone)

            <tr>
                <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
            </tr>

            <tr>
                <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                    Téléphone
                </td>
                <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                    {{ $contact_message->phone }}
                </td>
            </tr>

        @endif

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Reçu le
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ formattedDate($contact_message->created_at) }}
            </td>
        </tr>

    </table>

    <p style="font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px; margin:0;">
        Message
    </p>

    <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf; margin-bottom:24px;">
        <tr>
            <td style="padding:16px; font-size:14px; color:#3D2B1F; line-height:1.7;">
                {{ $contact_message->message }}
            </td>
        </tr>
    </table>

    <table style="width:100%;">
        <tr>
            <td style="text-align:center;">
                <a href="{{ route('messages', ['term' => slugify($contact_message->first_name) . ' ' . slugify($contact_message->last_name)]) }}"
                   style="display:inline-block; background:#57A770; color:#ffffff; text-decoration:none; font-size:15px; font-weight:600; padding:12px 32px;">
                    Voir le message dans l'administration
                </a>
            </td>
        </tr>
    </table>

</x-layout.mail-layout>
