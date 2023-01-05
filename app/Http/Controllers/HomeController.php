<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Load homepage
     */
    public function index(){
        return view('app');
    }
}
