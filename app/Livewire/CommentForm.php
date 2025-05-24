<?php
namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class CommentForm extends Component
{
    public $name;
    public $message;
    public $attendance;

    public $comments = [];

    public function mount()
    {
        $this->comments = Comment::latest()->get();
    }

    public function submit()
    {
        $validated = Validator::make([
            'name' => $this->name,
            'message' => $this->message,
            'attendance' => $this->attendance,
        ], [
            'name' => 'required|min:3',
            'message' => 'required|min:5',
            'attendance' => 'required|in:1,0',
        ])->validate();

        Comment::create([
            'name' => $validated['name'],
            'ucapan' => $validated['message'],
            'kehadiran' => $validated['attendance'],
        ]);

        $this->reset(['name', 'message', 'attendance']);
        $this->comments = Comment::latest()->get();
    }

    public function render()
    {
        return view('theme.jawa.livewire.comment-form', [ // <= PASTIKAN path ini sesuai Blade-nya
            'comments' => $this->comments,
        ]);
    }
}
