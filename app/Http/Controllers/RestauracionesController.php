<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestauracionesController extends Controller
{
    public function index()
    {
        return view('restauraciones.index');
    }
}
