<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentComponent extends Component
{
    use WithPagination;
    public $addComment = true;
    public $editComment = false;
    public $name;
    public $comment;
    public $update_comment;



    public function store()
    {
        $this->validate([
            'name' => "required|string|max:255",
            'comment' => "required|string",
        ]);
        Comment::create([
            'name' => $this->name,
            'comment' => $this->comment
        ]);
        $this->reset(['name', 'comment']);
    }


    public function edit($id)
    {
        $this->addComment = false;
        $this->editComment = true;
        $this->update_comment = Comment::findOrFail($id);
        $this->name = $this->update_comment->name;
        $this->comment = $this->update_comment->comment;
    }
    public function update()
    {
        $this->update_comment->update([
            'name' => $this->name,
            'comment' => $this->comment
        ]);
        $this->reset(['name', 'comment']);
        $this->cancelEdite();
    }




    public function cancelEdite()
    {
        $this->addComment = true;
        $this->editComment = false;
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
    }

    public function render()
    {
        $comments = Comment::latest()->paginate(15);
        return view('livewire.comment-component', compact('comments'));
    }
}