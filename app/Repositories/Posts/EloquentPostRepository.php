<?php

namespace App\Repositories\Posts;
use App\Models\Post;        // import your Post moddel to PostController
use Illuminate\Support\Facades\Storage;     // import Storage to enable delete of images

class EloquentPostRepository implements PostContract{
    public function create($request){

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

        return $post;
    }


    public function show(){
        //$posts = Post::all();        // get everything from Post model
        //$posts = Post::orderBy('created_at', 'desc')->get();    // ordering sequence of post apperance
       $posts = Post::orderBy('created_at', 'desc')->paginate(10); 

       return $posts;
    }


    public function findID($id){
        //
        $post = Post::find($id);    // find post content with this id
        return $post;
    }


    public function edit($id, $request){
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

        return $post;
    }


    public function remove($id){
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

         return $post;
    }


}