@extends('layouts.blog_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert-container">
                            <div class="alert alert-success" role="alert">
                                <span class="closebtn">&times;</span> 
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                @if (count($posts) > 0)
                    <table class="table table-striped table-borderless">
                        <tr>
                            <th>Post Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a class="btn btn-primary py-1 px-2" href="/posts/{{$post->id}}/edit">EDIT</a></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger py-1 px-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        DELETE
                                    </button>
                                </td>
                            </tr>


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
                        @endforeach
                    </table>
                @else
                    <p class="display-3 px-2 py-3">No posts yet!</p>
                @endif
            </div>
        </div>
    </div>
</div>




@endsection
