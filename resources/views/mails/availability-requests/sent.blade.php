<x-layout.mail-layout>

    <p style="font-size:24px; color:#3D2B1F; font-weight:400; padding:0 0 12px; margin:0;">
        Nouvelle demande de disponibilité
    </p>

    <p style="font-size:14px; color:#6c6d6e; line-height:1.7; padding:0 0 24px; margin:0;">
        Un visiteur vient de soumettre une demande de disponibilité via le site.
        Vous trouverez ci-dessous les détails de sa demande.
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
                {{ $availability_request->first_name . ' ' . $availability_request->last_name }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Adresse e-mail
            </td>
            <td style="padding:12px 16px; text-align:right;">
                <a href="mailto:{{ $availability_request->email }}"
                   style="font-size:14px; font-weight:500; color:#57A770; text-decoration:none;">
                    {{ $availability_request->email }}
                </a>
            </td>
        </tr>

        @if ($availability_request->phone)
            <tr>
                <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
            </tr>

            <tr>
                <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                    Téléphone
                </td>
                <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                    {{ $availability_request->phone }}
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
                {{ formattedDate($availability_request->created_at) }}
            </td>
        </tr>

    </table>

    <p style="font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px; margin:0;">
        Message
    </p>

    <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf; margin-bottom:24px;">
        <tr>
            <td style="padding:16px; font-size:14px; color:#3D2B1F; line-height:1.7;">
                {{ $availability_request->message }}
            </td>
        </tr>
    </table>

    <table style="width:100%;">
        <tr>
            <td style="text-align:center;">
                <a href="{{ route('availabilities', ['term' => slugify($availability_request->first_name) . ' ' . slugify($availability_request->last_name)]) }}"
                   style="display:inline-block; background:#57A770; color:#ffffff; text-decoration:none; font-size:16px; font-weight:600; padding:12px 32px;">
                    Voir la demande dans l'administration
                </a>
            </td>
        </tr>
    </table>

</x-layout.mail-layout>
