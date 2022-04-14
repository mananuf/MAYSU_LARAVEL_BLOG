@extends('layouts/blog_layout')

@section('content')

    <div class="container-xxl py-5">
        <div class="container">
            <!-- header start -->
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">{{$page_title}}</h4>
                <h1 class="display-5 mb-4">Modern Architecture And Interior Design Blog</h1>
            </div>
            <!-- header end-->
            
            @if (count($posts) > 0)
            
                <div class="row g-4">
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item d-flex position-relative text-center h-100">
                                <img class="bg-img" src="/storage/post_images/{{$post->post_images}}" alt="">
                                <div class="service-text p-5">
                                    <img class="mb-4" src="{{asset('img/icons/icon-5.png')}}" alt="Icon">
                                    <h3 class="mb-3"> {{$post->title}} </h3>
                                    <small class="text-default"> writen by {{$post->user->name}} <br> on {{$post->created_at}} </small>
                                    <p class="mb-4" id="post-body">{!! $post->body !!}</p>
                                    <a class="btn" href="/posts/{{$post->id}}"><i class="fa fa-plus text-primary me-3"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach  
                </div>
                {{-- paginate --}}
                <div class="d-flex justify-content-center mt-4">
                    {!! $posts->links() !!}
                </div>
            @else
                <p class="mb-4">No post made yet</p>
            @endif

        </div>
        
    </div>
    <div id="paginate">
        
    </div>
@endsection