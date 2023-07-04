<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableOrdersController extends Controller
{
    public function __invoke()
    {
        return view('kamban.table');
    }
}
