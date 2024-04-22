<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

abstract class Controller
{
    //

    public function respond(array | Collection | AnonymousResourceCollection $data)
    {
        return response()->json($data);
    }
}
