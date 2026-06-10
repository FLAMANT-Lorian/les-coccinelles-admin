<x-layout.mail-layout>

    <p style="font-size:24px; color:#3D2B1F; font-weight:400; padding:0 0 12px; margin:0;">
        Rappel : votre événement approche !
    </p>

    <p style="font-size:14px; color:#6c6d6e; line-height:1.7; padding:0 0 24px; margin:0;">
        L'événement <strong>{{ $event->name }}</strong> aura lieu dans <strong>7 jours</strong>.
        Retrouvez ci-dessous toutes les informations utiles pour vous y préparer.
    </p>

    <p style="font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px; margin:0;">
        Détails de l'événement
    </p>

    <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf; margin-bottom:24px;">

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Événement
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ $event->name }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Début
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ formattedDate($event->start_date) }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Fin
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ formattedDate($event->end_date) }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Adresse
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ $event->address }}
            </td>
        </tr>

    </table>

    @if($event->description)

        <p style="font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px; margin:0;">
            Description
        </p>

        <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf; margin-bottom:24px;">
            <tr>
                <td style="padding:16px; font-size:14px; color:#3D2B1F; line-height:1.7;">
                    {{ $event->description }}
                </td>
            </tr>
        </table>

        <table style="width:100%;">
            <tr>
                <td style="text-align:center;">
                    <a href="{{ route('events.show', ['event' => $event->id]) }}"
                       style="display:inline-block; background:#57A770; color:#ffffff; text-decoration:none; font-size:16px; font-weight:600; padding:12px 32px;">
                        Voir l’événement
                    </a>
                </td>
            </tr>
        </table>

    @endif

</x-layout.mail-layout>
