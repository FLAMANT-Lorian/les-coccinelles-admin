@php
    use App\Enums\YesOrNo;use App\Models\Booking;use App\ValueObjects\Money;use Carbon\Carbon;
    /**
     * @var Booking $booking
     */
@endphp

    <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contrat de location pour {{ $booking->contact->full_name }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #111;
            margin: 40px;
            line-height: 1.4;
        }

        h1 {
            font-size: 22px;
            text-align: center;
            text-transform: uppercase;
            font-weight: normal;
            margin-bottom: 25px;
        }

        h2.title {
            font-size: 15px;
            font-weight: bold;
            margin: 18px 0 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }

        section {
            margin-bottom: 18px;
        }

        .row {
            margin-bottom: 6px;
        }

        .label {
            font-weight: normal;
            color: #333;
        }

        strong {
            font-weight: bold;
        }

        p {
            margin-bottom: 8px;
            text-align: justify;
        }

        .signature {
            padding-top: 24px;
        }
    </style>
</head>
<body>
    @include('pdfs.contract.pages.page1')

    @pageBreak

    @include('pdfs.contract.pages.page2')

    @pageBreak

    @include('pdfs.contract.pages.page3')
</body>
</html>
