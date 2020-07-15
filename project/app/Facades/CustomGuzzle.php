<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;
use App\Helpers\CustomGuzzleBuilder;

class CustomGuzzle extends Facade
{

    protected static function getFacadeAccessor() {

        return CustomGuzzleBuilder::class;
    }
}
