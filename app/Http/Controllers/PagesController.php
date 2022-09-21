<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //------ home page -------------
    public function index()
    {
        $title = 'Welcome To Home Page';    // variable to be passed into blade template

        // return view('pages/index', compact('title'));        // way of injectin into template 
        return view('pages/index')->with('title', $title);    // preferred way
    }


    // ----- about page ------------
    public function about()
    {
        $title = 'About Us';

        return view('pages/about')->with('title', $title);
    }


    // ----- services page ------------
    public function services()
    {
        $data = [
            'title' => 'Our Services',
            'services' => ['Web Developement', 'Machine Learning', 'AI', 'Robotics']
        ];

        return view('pages/services')->with($data);   // injecting into blade, with multiple values
    }

    // ----- about page ------------
    public function contact()
    {
        $title = 'Contact us';

        return view('pages/contact')->with('title', $title);
    }
}
