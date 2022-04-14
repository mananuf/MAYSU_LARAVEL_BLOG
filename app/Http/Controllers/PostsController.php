<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     // import Storage to enable delete of images
use App\Models\Post;        // import your Post moddel to PostController

class PostsController extends Controller
{




      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);      // authentication access to pages [display only [index and show to guest users]]
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Maysu Blog';
        //$posts = Post::all();        // get everything from Post model
       // $posts = Post::orderBy('created_at', 'desc')->get();    // ordering sequence of post apperance
       $posts = Post::orderBy('created_at', 'desc')->paginate(10); 

        return view('posts/index')->with(['posts'=>$posts, 'page_title'=>$page_title]) ;     // homepage of blog
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'post_image' => 'image|nullable|max:1999',  // file must be an image, can be left blank, 
                                                        //  must not exceed 2mb
        ]);

        // FILE HANDLING
        if($request->hasFile('post_image')){    // if any file was uploaded
            
            // Get filename with the extension
            $filenameWithExt = $request->file('post_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just extension 
            $extension = $request->file('post_image')->getClientOriginalExtension();

            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            // Upload image
            $path = $request->file('post_image')->storeAs('public/post_images', $filenameToStore);
        }
        else{
            // Filename to store
            $filenameToStore ='default.jpg';
        }


        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;    //get id of current user making that post
        $post->post_images = $filenameToStore;  // get image to store
        $post->save();

        return redirect('/posts')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);    // find post content with this id
        
        return view('posts/show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);    // find post content with this id

        // check for correct user
        if( auth()->user()->id !== $post->user_id ){    // if current user is not the post owner
            // disallow edit access
            return redirect('/posts')->with('error', 'Unauthorized page access');  // redirect back to posts
        }
        
        return view('posts/edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         //
         $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
        ]);

        // FILE HANDLING
        if($request->hasFile('post_image')){    // if any file was uploaded
            
            // Get filename with the extension
            $filenameWithExt = $request->file('post_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just extension 
            $extension = $request->file('post_image')->getClientOriginalExtension();

            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            // Upload image
            $path = $request->file('post_image')->storeAs('public/post_images', $filenameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('post_image')){    // change image only if the user uploaded a new one again
            $post->post_images = $filenameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);    // get post by Id

        // check for correct user
        if( auth()->user()->id !== $post->user_id ){    // if current user is not the post owner
            // disallow delete access
            return redirect('/posts')->with('error', 'Unauthorized page access');  // redirect back to posts
        }

        // deleting files
        if($post->post_images != 'default.jpg'){
            // delete images
            Storage::delete('/public/post_images'.$post->post_images);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post was deleted successfully');
    }
}
