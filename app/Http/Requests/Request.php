<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\Data;

abstract class Request extends FormRequest
{
    protected Data|string $data;

    public function dto(): Data
    {
        return $this->data::from($this->validated());
    }
}
