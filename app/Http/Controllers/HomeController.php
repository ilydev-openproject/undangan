<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $invitation = (object) [
            'groom_name' => 'Ahmad',
            'groom_nickname' => 'Ahmad',
            'bride_name' => 'Siti',
            'bride_nickname' => 'Siti',
            'event_date' => '2025-12-12',
        ];

        return view('base.home', compact('invitation'));
    }
}
