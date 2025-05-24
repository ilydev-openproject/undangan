<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show($slug, $guest = null)
    {
        $invitation = Invitation::with([
            'brideFather',
            'brideMother',
            'groomFather',
            'groomMother',
            'event',
            'story',
            'rekening.bank'
        ])->where('slug', $slug)->firstOrFail();

        $guestName = $guest ? ucwords(str_replace('-', ' ', $guest)) : null;

        return view('theme.jawa.invitations.show', [
            'invitation' => $invitation,
            'guestName' => $guestName, // Selalu dikirim
        ]);
    }


    public function showWithGuest($slug, $guest)
    {
        $invitation = Invitation::with([
            'brideFather',
            'brideMother',
            'groomFather',
            'groomMother',
            'event',
            'story',
            'rekening.bank'
        ])->where('slug', $slug)->firstOrFail();

        $guestName = $guest ? ucwords(str_replace('-', ' ', $guest)) : null;

        return view('theme.jawa.invitations.show', [
            'invitation' => $invitation,
            'guestName' => $guestName,
        ]);
    }


}
