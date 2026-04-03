<?php

use App\Models\User;

describe('GUEST USER', function () {
    it('verifies if you are redirected to "/login" when you try to access to "/" route', function () {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    });

    it('verifies if a a guest can access to "/login"', function () {
        $response = $this->get(route('login'));

        $response->assertOk();
    });

    it('verifies if a guest user is redirected to login if he is not connected', function () {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    });
});

describe('CONNECTED USER', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    });

    it('verifies if a authenticated user can access to "/dashboard"', function () {
        $response = $this->get(route('dashboard'));

        $response->assertOk();
    });
});
