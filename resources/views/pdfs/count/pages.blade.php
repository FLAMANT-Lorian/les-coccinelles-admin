@php
    use App\Models\Booking;
    use App\ValueObjects\Money;

    /**
     * @var Booking $booking
     */
@endphp

    <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $booking->uniqid }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
            line-height: 1.5;
        }

        h1 {
            font-size: 28px;
            margin: 0;
            text-transform: uppercase;
        }

        h2 {
            font-size: 16px;
        }

        .header-table td {
            vertical-align: top;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th {
            background: #f3f4f6;
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
            text-transform: uppercase;
        }

        .invoice-table td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .invoice-table tr:last-child td {
            border-bottom: none;
            background-color: #e5e7eb;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .footer {
            position: fixed;
            inset: 0;
            top: auto;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    @include('pdfs.count.pages.page1')

    <div class="footer">
        Décompte générée automatiquement — {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
