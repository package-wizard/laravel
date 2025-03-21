<?php

use function Pest\Laravel\getJson;

it('success', function () {
    $id = fake()->uuid();

    getJson(route('inspires', ['id' => $id]))
        ->assertSuccessful()
        ->assertJsonPath('request.id', $id)
        ->assertJsonStructure([
            'data' => [
                '*' => ['quote', 'author'],
            ],
        ]);
});

it('invalid', function () {
    getJson(route('inspires'))
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'id' => __('validation.required', ['attribute' => 'id']),
        ]);
});
