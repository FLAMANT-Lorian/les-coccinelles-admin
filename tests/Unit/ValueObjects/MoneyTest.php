<?php

use App\ValueObjects\Money;

it('verifies if you can get cents from euro value and euros from cents', function () {
    $euros = 10.35;
    $cents = 34567;

    $centsFromEuros = Money::fromEuros($euros);
    $centsFromCents = Money::fromCents($cents);

    expect($centsFromEuros->cents())->toBe(1035)
    ->and($centsFromCents->euros())->toBe(345.67);
});

it('verifies if you can add money values and recover a formatted value in euros', function () {
    $euros = Money::fromEuros(45.87);
    $cents = Money::fromCents(5413);

    $euros = $euros->add($cents);

    expect($euros->euros())->toBe(100.0)
    ->and($euros->format())->toBe('100,00 €');
});

it('verifies if you can subtract money values and recover a formatted value in euros', function () {
    $euros = Money::fromEuros(45.87);
    $cents = Money::fromCents(4584);

    $euros = $euros->subtract($cents);

    expect($euros->euros())->toBe(0.03)
        ->and($euros->format())->toBe('0,03 €');
});

it('verifies if it throws an exception when subtracting too much', function () {
    $euros = Money::fromEuros(45.87);
    $cents = Money::fromCents(4684);

    $euros = $euros->subtract($cents);
})->throws(Exception::class, 'Vous ne pouvez pas soustraire plus que la valeur actuelle');

it('verifies if you can manipulate cents in every direction', function () {
    $price = new Money(5025);

    $euros = $price->euros();
    $cents = $price->cents();
    $addition = $price->add(new Money(5025));
    $subtraction = $price->subtract(new Money(5025));

    expect($euros)->toBe(50.25)
        ->and($cents)->toBe(5025)
        ->and($addition->euros())->toBe(100.5)
        ->and($subtraction->euros())->toBe(0.0)
        ->and($price->format())->toBe('50,25 €')
        ->and($addition->format())->toBe('100,50 €')
        ->and($subtraction->format())->toBe('0,00 €');
});
