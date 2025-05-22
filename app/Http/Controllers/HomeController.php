<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil user dari database
        $user = User::all();

        // Event date contoh
        $eventDate = now()->addDays(30)->format('Y-m-d');

        return view('home', );
    }
}
