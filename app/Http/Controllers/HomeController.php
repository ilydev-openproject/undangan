<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $eventDate = '2024-12-25 19:00:00';

        return view('home', [
            'eventDate' => $eventDate
        ]);
    }
}
