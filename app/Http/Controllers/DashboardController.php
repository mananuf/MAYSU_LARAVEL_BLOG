<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // identifying posts by its user
        $user_id = auth()->user()->id;      // get user id
        $user = User::find($user_id);       // find user

        return view('dashboard')->with('posts', $user->posts);  // return with user-to-posts relationships 
    }
}
