<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\post;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Repository\asideRepository;

class PostController extends Controller
{

    public function getDashboard()
    {
        $posts = post::orderBy('created_at', 'desc')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function getBlogs(asideRepository $aside)
    {
        $asideCategories = $aside->getAsideCategories();
        $asideArchives = $aside->getAsideArchives();

        $posts = post::orderBy('created_at', 'desc')->get();

        return view('blogs/blogs', compact('posts', 'asideCategories', 'asideArchives'));
    }

    public function readMore($post_id, asideRepository $aside)
    {
        $asideCategories = $aside->getAsideCategories();
        $asideArchives = $aside->getAsideArchives();
        $replies = null;
        $posts = post::where('id', $post_id)->get();
        $comments = comment::where('post_id', $post_id)->get();
        $user = Auth::user();
        foreach ($comments as $comment) {
            $replies = reply::where('comment_id', $comment->id)->get();

        }
        return view('readmore', compact('posts', 'replies', 'comments', 'user', 'asideCategories', 'asideArchives'));

    }

    public function postCreatePost(Request $request)
    {
        //validation
        $this->validate($request, [
            'body' => 'required| max:1000'
        ]);
        $post = new post();
        $post->body = $request['body'];
        $post->type = $request['categories'];
        $message = 'there was not error';
        if ($request->user()->posts()->save($post)) {
            $message = 'post successfuly created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function getDeletePost($post_id)
    {
        $post = post::where('id', $post_id)->first();
        if (Auth::User() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'successfully deleted!']);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required']);
        $post = Post::find($request['postId']);
        if (Auth::User() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }

    public function postEditComment(Request $request)
    {
        $this->validate($request, [
            'body' => 'required']);
        $comment = comment::find($request['postId']);
        $comment->comment = $request['body'];
        $comment->update();
        return response()->json(['new_body' => $comment->comment], 200);
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::User();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }

    public function postComment(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post_body = $request['body'];
        $post_id = $request['postId'];
        $user = Auth::User();
        $comment = new Comment();

        $comment->user_id = $user->id;
        $comment->post_id = $post_id;
        $comment->comment = $post_body;
        $comment->save();
        return redirect()->route('blog.readmore', ['post_id' => $post_id]);

    }

    public function postDeleteComment(Request $request)
    {
        $comment = comment::where('id', $request['postId'])->first();
        if (Auth::User() != $comment->user) {
            return redirect()->back();
        }
        $comment->delete();
        return redirect()->route('dashboard')->with(['message' => 'successfully deleted!']);
    }

    public function postReply(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $replyBody = $request['body'];
        $commentId = $request['commentId'];
        $postId = $request['postId'];
        $user = Auth::User();
        $reply = new Reply();
        $reply->user_id = $user->id;
        $reply->comment_id = $commentId;
        $reply->reply = $replyBody;
        $reply->save();
        return redirect()->route('blog.readmore', ['post_id' => $postId]);
    }

    public function getReply(Request $request)
    {
        $replies = reply::where('comment_id', $request['commentId'])->get();

        return response()->json(['replies' => $replies], 200);
    }

    public function getNavigation(asideRepository $aside, $type)
    {
        $asideCategories = $aside->getAsideCategories();
        $asideArchives = $aside->getAsideArchives();
        switch ($type) {
            case 'libraries':
                $posts = post::where('type', 1)->orderBy('created_at', 'desc')->get();
                break;
            case'others':
                $posts = post::where('type', 2)->orderBy('created_at', 'desc')->get();
                break;
            case'devotional':
                $posts = post::where('type', 3)->orderBy('created_at', 'desc')->get();
                break;
            case'conservative':
                $posts = post::where('type', 4)->orderBy('created_at', 'desc')->get();
                break;
            case'journey':
                $posts = post::where('type', 5)->orderBy('created_at', 'desc')->get();
                break;
            case'paper':
                $posts = post::where('type', 6)->orderBy('created_at', 'desc')->get();
                break;
            default:
                $posts = post::orderBy('created_at', 'desc')->get();
                break;
        }


        return view('blogs/libraries', compact('posts', 'asideCategories', 'asideArchives'));
    }

}
