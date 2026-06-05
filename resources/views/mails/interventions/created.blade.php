@php use App\Models\Intervention; @endphp
@php
    /** @var Intervention $intervention */
@endphp

<x-layout.mail-layout>

    <main style="padding:32px;font-family:Arial,Helvetica,sans-serif;color:#3D2B1F;">

        <h2 style="font-size:24px;margin:0 0 12px;color:#3D2B1F;">
            Une intervention vous a été assignée !
        </h2>

        <p style="margin:0 0 24px;font-size:14px;line-height:1.7;color:#6c6d6e;">
            Bonjour {{ $intervention->assignee->first_name }},
            une nouvelle intervention vient de vous être attribuée.
        </p>

        <!-- SECTION -->
        <h2 style="font-size:16px;margin:0 0 16px;font-weight:600;color:#3D2B1F;">
            Détails de l’intervention
        </h2>

        <table width="100%" cellpadding="0" cellspacing="0"
               style="background:#f6f6f6;border:1px solid #cfcfcf;border-radius:8px;padding:10px;">

            <tr>
                <td style="padding:6px 0;font-size:14px;font-weight:600;color:#6c6d6e;">
                    Intervention
                </td>
                <td style="padding:6px 0;font-size:14px;font-weight:500;color:#57A770;text-align:right;">
                    {{ $intervention->name }}
                </td>
            </tr>

            <tr><td colspan="2" style="border-top:1px solid #cfcfcf;"></td></tr>

            <tr>
                <td style="padding:6px 0;font-size:14px;font-weight:600;color:#6c6d6e;">
                    Assignée à
                </td>
                <td style="padding:6px 0;font-size:14px;font-weight:500;color:#57A770;text-align:right;">
                    {{ $intervention->assignee->full_name }}
                </td>
            </tr>

            <tr><td colspan="2" style="border-top:1px solid #cfcfcf;"></td></tr>

            <tr>
                <td style="padding:6px 0;font-size:14px;font-weight:600;color:#6c6d6e;">
                    Assignée le
                </td>
                <td style="padding:6px 0;font-size:14px;font-weight:500;color:#57A770;text-align:right;">
                    {{ formattedDate($intervention->created_at) }}
                </td>
            </tr>

        </table>

        @if($intervention->description)
            <h2 style="margin:24px 0 12px;font-size:16px;font-weight:600;color:#3D2B1F;">
                Description
            </h2>

            <div style="background:#f6f6f6;border:1px solid #cfcfcf;border-radius:8px;padding:16px;font-size:14px;line-height:1.7;color:#3D2B1F;">
                {{ $intervention->description }}
            </div>
        @endif

        <!-- NOTICE -->
        <div style="margin-top:24px;background:#F8D2C9;border-radius:8px;padding:16px;font-size:14px;line-height:1.4;color:#C6390E;">
            <strong>Rappel :</strong> pensez à marquer cette intervention comme complétée une fois celle-ci effectuée.
        </div>

    </main>

</x-layout.mail-layout>
