<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

abstract class Controller
{
    protected function dumpRawSql(): void
    {
        // cek environment
        if (!app()->environment('local')) {
            return;
        }
        DB::listen(function ($e) {
            dump($e->toRawSql(), $e->bindings, $e->time);
        });
    }
}
