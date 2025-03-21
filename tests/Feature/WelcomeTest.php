<?php

use function Pest\Laravel\get;

it('welcome page', function () {
    get(route('index'))
        ->assertSuccessful()
        ->assertSee('Watch video tutorials at');
});
