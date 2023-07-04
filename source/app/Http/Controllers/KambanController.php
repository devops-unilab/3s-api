<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KambanController extends Controller
{
    public function __invoke()
    {
        return view('kamban.index');
    }
}
