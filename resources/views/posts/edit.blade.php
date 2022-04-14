@extends('layouts/blog_layout')

@section('content')

    {{--              return post requests to store view --}}
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype'=> 'multipart/form-data']) !!}     <!-- use particular post id -->
        <div class="container-xxl py-5">
            
            <div class="container">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.5s">
                    @include('includes/messages')
                    <div class="g-3">
                        <div class="col-12 col-sm-6">
                        {{ Form::label('title', 'Edit Title');}}
                        {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder'=>'Create a Title']);}}
                        </div>
                        <div class="col-12 col-sm-6 mt-4">
                            {{ Form::label('body', 'Content');}}
                            {{ Form::textarea('body', $post->body, ['class' => 'ckeditor form-control', 'placeholder'=>'type your content...']);}}
                        </div>
                        <div class="col-12 col-sm-6 mt-4">
                            {{ Form::file('post_image');}}
                        </div>
                        {{ Form::hidden('_method','PUT')}}
                        <div class="col-12 col-sm-6 mt-3">
                            {{ Form::submit('Edit', ['class'=>'btn btn-primary']);}}
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    {!! Form::close() !!}
@endsection

