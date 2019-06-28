<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function Comment()
    {
        return view('backend.comment.comment');
    }
    public function EditComment()
    {
        return view('backend.comment.editcomment');
    }
}
