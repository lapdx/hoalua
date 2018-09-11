<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use function view;

class InoutputController extends Controller
{
    public function index (){
        return view('system.inoutput.index');
    }
}