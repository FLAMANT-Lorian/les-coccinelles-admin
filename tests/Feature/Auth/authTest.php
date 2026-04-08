<?php

use App\Models\User;

describe('GUEST USER', function () {
    beforeEach(function () {
        $this->locale = config('app.locale');
    });

    it('verifies if you are redirected to "/fr" when you try to access to "/" route', function () {
        $response = $this->get('/');

        $response->assertRedirect('/' . $this->locale);
    });

    it('verifies if you are redirected to "/fr/login" when a guest try to access to "/fr/"', function () {
        $response = $this->get(route('dashboard', ['locale' => $this->locale]));

        $response->assertRedirect(route('login', ['locale' => $this->locale]));
    });

    it('verifies if a a guest can access to "/fr/login"', function () {
        $response = $this->get(route('login', ['locale' => $this->locale]));

        $response->assertOk();
    });

    it('verifies if a guest user is redirected to login if he is not connected', function () {
        $response = $this->get(route('dashboard', ['locale' => $this->locale]));

        $response->assertRedirect(route('login', ['locale' => $this->locale]));
    });
});

describe('CONNECTED USER', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        $this->locale = config('app.locale');
    });

    it('verifies if a authenticated user can access to "/fr/"', function () {
        $response = $this->get(route('dashboard', ['locale' => $this->locale]));

        $response->assertOk();
    });
});
