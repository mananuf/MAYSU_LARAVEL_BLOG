@extends('layouts/blog_layout')

@section('content')
<div class="container">
    <div class="row g-5">
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="about-img">
                <img class="bg-img" src="/storage/post_images/{{$post->post_images}}" alt="">
                <img class="bg-img" src="/storage/post_images/{{$post->post_images}}" alt="">
            </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            
            <h1 class="display-5 mb-4"> {{ $post->title }} </h1>
            
            <p>{!!$post->body!!}</p>
            <hr>
            <p class="section-title"><small>written on {{$post->created_at}} by {{$post->user->name}}</small></p>
            
            <div class="w-100 d-flex justify-content-between" >
                <a class="btn btn-primary py-3 px-5" href="/posts">Back to Posts</a>
                
                <!-- only logged in users should see action buttons -->
                @if (!Auth::guest())
                    <!-- only owner of post should be able to edit | delete -->
                    @if (Auth::user()->id == $post->user_id)
                      <a class="btn btn-primary py-3 px-5 pull-right" href="/posts/{{$post->id}}/edit">Edit</a>      <!-- use the id to get specific post you want to edit -->
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-danger px-5 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          DELETE
                      </button>
                    @endif
                @endif
                
            </div>
        </div>
    </div>
</div>
</div>

 
  <!-- DELETE Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          are you sure you wan to delete <strong> {{$post->title}} </strong>post? 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          {{-- delete action --}}
            {!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right ']) !!}
                {{Form::hidden('_method','DELETE')}}       <!-- spoofing method type-->
                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}

            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection