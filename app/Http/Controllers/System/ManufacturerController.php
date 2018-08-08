<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use function view;

class ManufacturerController extends Controller
{
    public function index (){
        return view('system.manufacturer.index');
    }
}