<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //public function index()
    public function __invoke()
    {
    	return view("welcome");
    }
}
