<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show($slug)
    {
        $invitation = Invitation::with(['brideFather', 'brideMother', 'groomFather', 'groomMother', 'event', 'story', 'rekening.bank'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('invitations.show', compact('invitation'));
    }

}
