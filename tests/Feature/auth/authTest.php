<?php

it('verifies if you are redirected to "/login" when you try to access to "/" route', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('login'));
});

it('verifies if a a guest can access to "/login"', function () {
    $response = $this->get(route('login'));

    $response->assertOk();
});
