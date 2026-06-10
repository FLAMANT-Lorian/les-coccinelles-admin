@php use App\Enums\InterventionStatus; @endphp

<x-layout.mail-layout>

    <p style="font-size:24px; color:#3D2B1F; font-weight:400; padding:0 0 12px; margin:0;">
        Rappel : intervention à venir
    </p>

    <p style="font-size:14px; color:#6c6d6e; line-height:1.7; padding:0 0 24px; margin:0;">
        Une intervention est planifiée prochainement.
        Retrouvez ci-dessous les informations essentielles concernant cette tâche.
    </p>

    <p style="font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px; margin:0;">
        Détails de l’intervention
    </p>

    <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf; margin-bottom:24px;">

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Nom
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ $intervention->name }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Statut
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ __('enums.' . InterventionStatus::from($intervention->status)->value) }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Échéance
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ formattedDate($intervention->deadline) }}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-top:1px solid #cfcfcf;"></td>
        </tr>

        <tr>
            <td style="text-align:left; padding:12px 16px; font-size:14px; font-weight:600; color:#6c6d6e;">
                Assigné à
            </td>
            <td style="padding:12px 16px; font-size:14px; font-weight:500; color:#57A770; text-align:right;">
                {{ $intervention->assignee->full_name ?? 'Non assigné' }}
            </td>
        </tr>

    </table>

    @if($intervention->description)

        <p style="font-size:16px; font-weight:500; color:#3D2B1F; padding:0 0 16px; margin:0;">
            Description
        </p>

        <table style="width:100%; background:#f6f6f6; border:1px solid #cfcfcf;">
            <tr>
                <td style="padding:16px; font-size:14px; color:#3D2B1F; line-height:1.7;">
                    {{ $intervention->description }}
                </td>
            </tr>
        </table>

    @endif

</x-layout.mail-layout>
