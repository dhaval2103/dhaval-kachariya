<?php

namespace App\Http\Controllers\userblog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blogvalidation;
use App\Http\Requests\Commentvalidation;
use App\Http\Requests\ImageValidation;
use App\Models\blog;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Blogcontroller extends Controller
{
    public function ublog()
    {
        return view('auth.blog.blog');
    }
    public function welcome()
    {
        $query = Blog::all();
        return view('welcome', compact('query'));
    }

    public function addblog(ImageValidation $request)
    {

        $input = $request->all();
        if ($request->file('image')) {
            $imageName = $request->file('image');
            $destinationPath = 'images/';
            $profileImage = time() . "." . $imageName->extension();
            $imageName->move($destinationPath, $profileImage);
            if ($input['frmid']) {
                $cust = blog::find($input['frmid']);
                @unlink($cust->image);
            }
            $input['image'] = $profileImage;
        }

        $add = new blog;
        $add->title = $request->title;
        $add->description = $request->description;
        $add->image = $input['image'];
        $add->user_id = Auth::user()->id;
        $add->save();
        return response()->json('1');
    }

    public function viewblog(Request $request)
    {
        $query = blog::where('user_id', Auth::user()->id)->get();
        return view('auth.blog.editblog', compact('query'));
    }


    public function blogedit(Request $request)
    {
        $query = blog::where('id', $request->id)->first();
        return Response()->json($query);
    }


    public function blogupdate(Blogvalidation $request)
    {
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = public_path('images');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        if ($request->file('image') == "") {
            $cust = DB::table('blogs')->where('id', $input['formid'])->first();
            $input['image'] = $cust->image;
        }

        if ($input['formid']) {
            $arr = [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $input['image']
            ];

            blog::where('id', $input['formid'])->update($arr);
            return response()->json('1');
        }
    }


    public function blogdelete(Request $req)
    {
        $imageName = blog::find($req->id);
        unlink('images/' . $imageName->getRaworiginal('image'));
        blog::where("id", $imageName->id)->delete();
        return response()->json('1');

        $id = $req->id;
        $query = blog::find($id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Has Been Deleted']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something Wrong']);
        }
    }


    public function bloglike(Request $request)
    {
        $a = Like::where('user_id', Auth::user()->id)->where('blog_id', $request->id)->first();
        if (empty($a)) {
            $data = new Like;
            $data->user_id = Auth::user()->id;
            $data->blog_id = $request->id;
            $data->save();

            $count = DB::table('likes')->where('blog_id', $request->id)->count();
            return response()->json(['success' => '1', 'data' => $count, 'id' => $request->id]);
        } else {
            return response()->json(['success' => '0']);
        }
    }


    public function addcomment(Commentvalidation $request)
    {
        // date_default_timezone_set("Asia/Kolkata");

        $com = new Comment;
        $com->user_id = Auth::user()->id;
        $com->blog_id = $request->blogid;
        $com->comment = $request->comments;
        $com->save();
        $countcomment = DB::table('comments')->where('blog_id', $request->blogid)->where('user_id', Auth::user()->id)->count();
        return response()->json(['success' => '1', 'data' => $countcomment, 'id' => $request->blogid]);
    }


    public function viewcomment(Request $request)
    {
        $query = Comment::where('blog_id', $request->id)->get();
        return Response()->json($query);
    }


    public function dltcomment(Request $request)
    {
        $query = Comment::where('id', $request->id)->delete();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Has Been Deleted']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something Wrong']);
        }
    }


    public function multilike(Request $request)
    {
        $a = Like::where('user_id', Auth::user()->id)->where('blog_id', $request->id)->first();
        if (empty($a)) {
            $data = new Like;
            $data->user_id = Auth::user()->id;
            $data->blog_id = $request->id;
            $data->save();

            $count = DB::table('likes')->where('blog_id', $request->id)->count();
            return response()->json(['success' => '1', 'data' => $count, 'id' => $request->id]);
        } else {
            $data = Like::where('user_id', Auth::user()->id)->where('blog_id', $request->id)->delete();
            $count = DB::table('likes')->where('blog_id', $request->id)->count();
            return response()->json(['success' => '0', 'data' => $count, 'id' => $request->id]);
        }
    }


    public function multiviewcomment(Request $request)
    {
        $arr = array();
        $query = Comment::where('blog_id', $request->id)->get();

        foreach ($query as $user) {
            $arr[] = User::where('id', $user->user_id)->select('id', 'name')->first();
        }

        return response()->json(['query' => $query, 'user' => $arr]);
    }


    public function commentedit(Request $request)
    {
        $query = Comment::where('id', $request->id)->first();
        return Response()->json($query);
    }


    public function commentupdate(Request $request)
    {
        $input = $request->all();
        if ($input['commenteditid']) {
            $arr = [
                'comment' => $request->editcomments
            ];

            Comment::where('id', $input['commenteditid'])->update($arr);
            return response()->json('1');
        }
    }


    public function editspecificcomment(Request $request)
    {
        $query = Comment::where('id', $request->id)->first();
        return Response()->json($query);
    }


    public function updatespecificcomment(Request $request)
    {
        $input = $request->all();
        if ($input['commenteditid']) {
            $arr = [
                'comment' => $request->editcomments
            ];

            Comment::where('id', $input['commenteditid'])->update($arr);
            return response()->json('1');
        }
    }


    public function deletespecificcomment(Request $request)
    {
        $query = Comment::where('id', $request->id)->delete();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Has Been Deleted']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something Wrong']);
        }
    }


    public function showcomment(Request $request)
    {
        $query = blog::where('id', $request->id)->first();
        $a = Comment::where('blog_id', $request->id)->get();
        return view('auth.blog.showcommentlist', compact('query', 'a'));
    }


    public function displaycomment(Request $request)
    {
        $query = blog::where('id', $request->id)->first();
        return view('auth.displaycomment', compact('query'));
    }

    // public function showallblog(Request $request)
    // {
    //     $query = Blog::all();
    //     return view('auth.blog.viewallblog', compact('query'));
    // }


    // public function index()
    // {
    //     return view('home');
    // }

}
