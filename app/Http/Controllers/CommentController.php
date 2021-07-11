<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Users;
use App\Models\Posts;

class CommentController extends Controller
{
    //

    public function postAdd(Request $request)
    {
        
        $input['from_user'] = $request->user()->id;
        $input['on_post'] = $request->input('on_post');
        $input['body'] = $request->input('body');
        $slug = $request->input('slug');
        Comments::create($input);

        return redirect('showpost/'.$slug)->with('message', 'Comment published');
    }
}
