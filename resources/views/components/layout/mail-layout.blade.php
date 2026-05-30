<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <style>
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
            font-family: Arial, sans-serif;
        }

        .wrapper {
            max-width: 600px;
            margin: auto;
            padding: 2rem;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #cfcfcf;
        }

        .header {
            background-color: #57A770;
            padding: 2rem;
        }

        .header-title {
            margin: 0;
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
            font-weight: 400;
            color: #ffffff;
        }

        .footer {
            padding: 1.25rem 2rem;
            background-color: #f6f6f6;
            border-top: 1px solid #cfcfcf;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-title {
            font-size: 14px;
            font-weight: 600;
            color: #3D2B1F;
        }

        .footer-no-reply {
            font-size: 12px;
            color: #9a9b9c;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="card">
            <header class="header">
                <h1 class="header-title">ASBL Les Coccinelles</h1>
            </header>

            {{ $slot }}

            <div class="footer">
                <span class="footer-title">ASBL Les Coccinelles</span>
                <span class="footer-no-reply">Ne pas répondre à cet e-mail !</span>
            </div>
        </div>
    </div>
</body>
</html>
