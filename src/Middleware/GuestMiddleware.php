<?php

namespace App\Middleware;

use App\Kernel\Middleware\AbstractMiddleware;
use App\Kernel\Middleware\Middleware;

class GuestMiddleware extends AbstractMiddleware
{

    public function handle(): void
    {
        if ($this->auth->check()) {
            $this->redirect->to('/home');
        }
    }
}