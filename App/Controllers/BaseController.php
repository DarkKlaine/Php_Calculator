<?php

namespace App\Controllers;

use App\DTO\Request;

class BaseController
{
    public function run(Request $request, string $parameter): void
    {
        match ($parameter) {
            'session' => $this->showPersonal(),
            'general' => $this->showGeneral(),
            'ui' => $this->showForm($request),
            'calculate' => $this->calculate($request),
            default => exit(),
        };

    }
}