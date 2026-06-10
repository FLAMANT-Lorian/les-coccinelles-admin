<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
</head>

<body style="margin:0; padding:0; background:#f6f6f6; font-family:Arial, sans-serif;">

    <table style="width:100%; background:#f6f6f6; padding:20px 0;">
        <tr>
            <td style="text-align:center;">
                <table
                    style="width:600px; background:#ffffff; border:1px solid #cfcfcf; overflow:hidden; margin:0 auto; border-collapse: collapse;">
                    <tr>
                        <td style="background:#57A770; padding:30px; text-align:center; color:#ffffff; font-size:20px; font-weight:400; text-transform:uppercase;">
                            ASBL Les Coccinelles
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;">
                            {{ $slot }}
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f6f6f6; border-top:1px solid #cfcfcf; padding:20px;">
                            <table style="width:100%;">
                                <tr>
                                    <td style="text-align:left; font-size:14px; font-weight:600; color:#3D2B1F;">
                                        ASBL Les Coccinelles
                                    </td>
                                    <td style="text-align:right; font-size:12px; color:#9a9b9c;">
                                        Ne pas répondre à cet e-mail !
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
