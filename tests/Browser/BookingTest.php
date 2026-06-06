<?php

use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\PermissionSeeder;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;
use function Pest\Laravel\actingAs;

describe('BOOKINGS BROWSER TESTING', function () {
    beforeEach(function () {
        $this->withoutMiddleware([
            LaravelLocalizationRoutes::class,
            LaravelLocalizationRedirectFilter::class,
            LocaleSessionRedirect::class,
            LocaleCookieRedirect::class,
        ]);

        $this->seed([PermissionSeeder::class]);

        $user = User::factory()->create();
        $this->role = Role::create(['name' => 'admin', 'unique' => 1]);
        $permission = Permission::all();
        $this->role->givePermissionTo($permission);
        $user->assignRole($this->role);

        actingAs($user);
    });

    it('create a booking', function () {
        $contact = Contact::factory()->create();
        $type = HallRate::factory()->create()->type;

        $start_date = Carbon::now()->translatedFormat('F j, Y');
        $end_date = Carbon::now()->addDay()->translatedFormat('F j, Y');

        visit(route('bookings.index'))
            ->click('Ajouter une réservation')
            ->click('[title="Contact associé à la réservation"]')
            ->click($contact->full_name)
            ->click('[title="Type de réservation"]')
            ->click($type)
            ->click('[title="État de la caution"]')
            ->click('Payée')
            ->fill('billing_address', fake()->address)
            ->click('#dates')
            ->click('.open [aria-label="' . $start_date . '"]')
            ->click('.open [aria-label="' . $end_date . '"]')
            ->click('#handover_date')
            ->click('.open [aria-label="' . $start_date . '"]')
            ->click('#return_date')
            ->click('.open [aria-label="' . $end_date . '"]')
            ->fill('handover_hour', Carbon::now()->format('H:i'))
            ->fill('return_hour', Carbon::now()->format('H:i'))
            ->click('Créer la réservation')
            ->assertSee($contact->full_name);
    });

    it('generate à contract', function () {
        Pdf::fake();

        $booking = Booking::factory()
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(MeterReading::factory())
            ->has(BookingDate::factory())
            ->create();

        visit(route('bookings.index'))
            ->click($booking->contact->full_name)
            ->assertSee('Générer le contrat de location')
            ->click('Générer le contrat de location');

        Pdf::assertRespondedWithPdf(function (PdfBuilder $pdf) use ($booking) {
            return $pdf->downloadName === 'contrat-location-' . $booking->uniqid . '.pdf'
                && $pdf->isDownload()
                && $pdf->contains('Contrat');
        });
    });

});
