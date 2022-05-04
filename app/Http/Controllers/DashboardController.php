<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Dashboard\DashboardContract;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $repo;

    public function __construct(DashboardContract $dashboardContract)
    {
        $this->repo = $dashboardContract;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $user = $this->repo->display();

        return view('dashboard')->with('posts', $user->posts);  // return with user-to-posts relationships 
    }
}
