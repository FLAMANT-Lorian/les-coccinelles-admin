<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\UtilityCost;
use App\ValueObjects\Money;
use Spatie\LaravelPdf\PdfBuilder;
use function Spatie\LaravelPdf\Support\pdf;

class PdfController extends Controller
{
    public function generateContract(int $bookingId): PdfBuilder
    {
        $booking = Booking::with(['bookingDate', 'contact', 'hall_rate'])
            ->findOrFail($bookingId);

        $file_name = 'contrat-location-' . $booking->uniqid;

        return pdf()
            ->view('pdfs.contract.pages', ['booking' => $booking])
            ->name($file_name)
            ->download();
    }

    public function generateCount(int $bookingId): PdfBuilder
    {
        $booking = Booking::with(['hall_rate'])
            ->findOrFail($bookingId);

        $utilityCosts = $this->handleUtilityCosts($booking);

        $count = $this->handleSummary($utilityCosts, $booking);

        $file_name = 'decompte-' . $booking->uniqid;

        return pdf()
            ->view('pdfs.count.pages', [
                'booking' => $booking,
                'utility_costs' => $utilityCosts,
                'count' => $count
            ])->name($file_name)
            ->download();
    }

    public function generateInvoice(int $bookingId): PdfBuilder
    {
        $booking = Booking::with(['hall_rate'])
            ->findOrFail($bookingId);

        $utilityCosts = $this->handleUtilityCosts($booking);
        $invoice = $this->handleSummary($utilityCosts, $booking, 'invoice');

        $file_name = 'facture-' . $booking->uniqid;

        return pdf()
            ->view('pdfs.invoice.pages', [
                'booking' => $booking,
                'invoice' => $invoice
            ])->name($file_name)
            ->download();
    }

    public function handleSummary(array $utility_costs, Booking $booking, string $mode = null): array
    {
        $base_price = $booking->contact->member_card ? $booking->hall_rate->member_price : $booking->hall_rate->base_price;
        $deposit = $booking->hall_rate->deposit;
        $prepayment = $booking->prepayment ?? 0;
        $cleaning = $booking->cleaning ?? 0;
        $breaking = $booking->breaking ?? 0;

        if ($mode === 'invoice') {
            $price = Money::fromCents($base_price)
                ->add(Money::fromEuros($utility_costs['total']['total']))
                ->add(Money::fromCents($cleaning))
                ->add(Money::fromCents($breaking))
                ->euros();

            return [
                'base_price' => [
                    'label' => $booking->hall_rate->type,
                    'cost' => Money::fromCents($base_price)->euros()
                ],
                'utility_costs' => [
                    'label' => 'Charges',
                    'cost' => $utility_costs['total']['total'],
                ],
                'cleaning' => [
                    'label' => 'Frais de nettoyage',
                    'cost' => Money::fromCents($cleaning)->euros(),
                ],
                'breaking' => [
                    'label' => 'Écarts d’inventaire',
                    'cost' => Money::fromCents($breaking)->euros(),
                ],
                'total' => [
                    'label' => 'Total',
                    'cost' => $price > 0 ? $price : str_replace('-', '', $price)
                ]
            ];
        } else {
            $price = Money::fromCents($base_price)
                ->subtract(Money::fromCents($prepayment))
                ->subtract(Money::fromCents($deposit))
                ->add(Money::fromEuros($utility_costs['total']['total']))
                ->add(Money::fromCents($cleaning))
                ->add(Money::fromCents($breaking))
                ->euros();

            return [
                'base_price' => [
                    'label' => $booking->hall_rate->type,
                    'cost' => Money::fromCents($base_price)->euros()
                ],
                'prepayment' => [
                    'label' => 'Accompte',
                    'cost' => '- ' . Money::fromCents($prepayment)->euros()
                ],
                'deposit' => [
                    'label' => 'Caution',
                    'cost' => '- ' . Money::fromCents($deposit)->euros(),
                ],
                'utility_costs' => [
                    'label' => 'Charges',
                    'cost' => $utility_costs['total']['total'],
                ],
                'cleaning' => [
                    'label' => 'Frais de nettoyage',
                    'cost' => Money::fromCents($cleaning)->euros(),
                ],
                'breaking' => [
                    'label' => 'Écarts d’inventaire',
                    'cost' => Money::fromCents($breaking)->euros(),
                ],
                'total' => [
                    'label' => $price > 0 ? 'Montant à payer' : 'Montant à rembourser',
                    'cost' => $price > 0 ? $price : str_replace('-', '', $price)
                ]
            ];
        }
    }

    public function handleUtilityCosts(Booking $booking): array
    {
        $base = UtilityCost::all();

        // Eau
        $water = Money::fromCents($base->where('type', 'Eau')->first()->price)->euros();
        $water_general = $booking->meterReading->after_water_general - $booking->meterReading->before_water_general;
        $water_cdj = $booking->meterReading->after_water_cdj - $booking->meterReading->before_water_cdj;
        $water_final = $water_general - $water_cdj;
        $water_price = $water_final * $water;


        // Électricité
        $elec = Money::fromCents($base->where('type', 'Électricité')->first()->price)->euros();
        $elec_general = $booking->meterReading->after_electricity_general - $booking->meterReading->before_electricity_general;
        $elec_cdj = $booking->meterReading->after_electricity_cdj - $booking->meterReading->before_electricity_cdj;
        $elec_final = $elec_general - $elec_cdj;
        $elec_price = $elec_final * $elec;

        // MAZOUT
        $mazout = Money::fromCents($base->where('type', 'Mazout')->first()->price)->euros();
        $mazout_general = $booking->meterReading->after_mazout_general - $booking->meterReading->before_mazout_general;
        $mazout_price = $mazout_general * $mazout;

        // TOTAL
        $total_price = Money::fromEuros($water_price)
            ->add(Money::fromEuros($elec_price))
            ->add(Money::fromEuros($mazout_price))
            ->euros();

        return [
            'elec_general' => [
                'label' => 'Électricité',
                'before' => $booking->meterReading->before_electricity_general,
                'after' => $booking->meterReading->after_electricity_general,
                'diff' => $elec_general,
                'cost' => $elec . ' € / Kwh',
                'total' => Money::fromEuros($elec_general * $elec)->euros()
            ],
            'elec_cdj' => [
                'label' => 'Électricité CDJ',
                'before' => $booking->meterReading->before_electricity_cdj,
                'after' => $booking->meterReading->after_electricity_cdj,
                'diff' => $elec_cdj,
                'cost' => $elec . ' € / Kwh',
                'total' => '- ' . Money::fromEuros($elec_cdj * $elec)->euros()
            ],
            'water_general' => [
                'label' => 'Eau',
                'before' => $booking->meterReading->before_water_general,
                'after' => $booking->meterReading->after_water_general,
                'diff' => $water_general,
                'cost' => $water . ' € / m3',
                'total' => Money::fromEuros($water_general * $water)->euros()
            ],
            'water_cdj' => [
                'label' => 'Eau CDJ',
                'before' => $booking->meterReading->before_water_cdj,
                'after' => $booking->meterReading->after_water_cdj,
                'diff' => $water_cdj,
                'cost' => $water . ' € / m3',
                'total' => '- ' . Money::fromEuros($water_cdj * $water)->euros()
            ],
            'mazout' => [
                'label' => 'Mazout',
                'before' => $booking->meterReading->before_mazout_general,
                'after' => $booking->meterReading->after_mazout_general,
                'diff' => $mazout_general,
                'cost' => $mazout . ' € / U',
                'total' => Money::fromEuros($mazout_general * $mazout)->euros()
            ],
            'total' => [
                'label' => 'Total',
                'before' => '',
                'after' => '',
                'diff' => '',
                'cost' => '',
                'total' => $total_price
            ]
        ];
    }
}
