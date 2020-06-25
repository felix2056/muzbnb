<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Post;
use App\Model\PostViews;
use App\Model\WpUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     *  Add auth middleware
     *
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['only' => 'preview']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts['featured'] = Post::has('isFeatured')->where('post_status', 'publish')
            ->where('post_type', 'post')->limit(4)->get();
        $posts['adventures'] = Category::getPostsByCategory('adventures');
        $posts['tips'] = Category::getPostsByCategory('tips');
        $posts['community'] = Category::getPostsByCategory('community');
        $posts['news'] = Category::getPostsByCategory('news');

        return view('blog.index', compact('posts'));
    }

    public function redirect($id)
    {
//        if($id==0)
//        {
//            return back();
//        }
        $p = Post::findOrFail($id);
        if($p) {
            if($p->post_status == 'publish' && $p->post_name != '') {
                return redirect()->route('blog-single', ['slug'=> $p->post_name]);
            } else {
                return redirect()->route('blog-preview', ['id'=> $p->ID]);
            }
        }
    }

    /**
     *   Single Listing
     *
     * @return \Illuminate\Http\Response
     */

    public function view($slug)
    {
        $post = Post::with(['author' => function($query){
                $query->where('user_status', '<', 1);
            }, 'author.metas', 'author.picPost'])
            ->where('post_name', $slug)
            ->where('post_status', 'publish')
            ->where('post_type', 'post')
            ->firstOrFail();
        $popular = PostViews::where('post_id',$post->ID)->first();
        if(!$popular) {
            $popular = new PostViews();
            $popular->post_id = $post->ID;
            $popular->view = 1;
        } else{
            $popular->view++;
        }
        $popular->save();
        $imgs = DB::table('wp_postmeta')
            ->join('wp_postmeta as meta2', 'meta2.post_id', '=', 'wp_postmeta.meta_value' )
            ->where('wp_postmeta.post_id', $post->ID)
            ->where('wp_postmeta.meta_key', '_thumbnail_id')
            ->where('meta2.meta_key', '_wp_attached_file')
            ->select("meta2.meta_value as image")->get();
        $img = null;
        if($imgs[0]) {
            $img = $imgs[0]->image;
        }
        //geting 5 popular post
        $popularArticlesID = PostViews::orderBy('view','desc')->limit(5)->get();
        $popularArticles=[];
        $i=0;
        foreach ($popularArticlesID as $pid)
        {
            $popularArticles[$i] = Post::with(['author' => function($query){
                $query->where('user_status', '<', 1);
            }, 'author.metas', 'author.picPost'])
                ->where('ID', $pid->post_id)
                ->where('post_status', 'publish')
                ->where('post_type', 'post')
                ->first();
            $i++;
        }
//        $popularArticles = Post::popularArticles($post->ID);

        $recentArticles = Post::recentArticles($post->ID);

        $authors = WpUser::has('posts')
            ->with('metas', 'picPost')
            ->where('user_status', '<', 1)
            ->where('ID', '!=', $post->ID)
            ->get();
//        dd($authors);
        return view('blog.view', compact('post', 'img', 'popularArticles', 'recentArticles', 'authors'));
    }
    /**
    *   Single Blog Preview for admin
    *
     * @return \Illuminate\Http\Response
    */
    public function preview($id)
    {
        $post = Post::with(['author' => function($query){
            $query->where('user_status', '<', 1);
        }, 'author.metas'])
            ->where('ID', $id)
            ->where('post_type', 'post')
            ->firstOrFail();
        $imgs = DB::table('wp_postmeta')
            ->join('wp_postmeta as meta2', 'meta2.post_id', '=', 'wp_postmeta.meta_value' )
            ->where('wp_postmeta.post_id', $post->ID)
            ->where('wp_postmeta.meta_key', '_thumbnail_id')
            ->where('meta2.meta_key', '_wp_attached_file')
            ->select("meta2.meta_value as image")->get();
        $img = null;
        if($imgs->first()) {
            $img = $imgs->first()->image;
        }
        $popularArticles = Post::popularArticles($post->ID);
        $recentArticles = Post::recentArticles($post->ID);
        $authors = WpUser::has('posts', 'picPost')
            ->with('metas', 'picPost')
            ->where('user_status', '<', 1)
            ->where('ID', '!=', $post->ID)
            ->get();
        return view('blog.view', compact('post', 'img', 'popularArticles', 'recentArticles', 'authors'));
    }
}
