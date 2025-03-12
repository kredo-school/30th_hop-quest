<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

    public function index(){
        return view('businessusers.profiles.posts');
    }

     public function profile(){
        return view('businessusers.profiles.posts');
    }

    public function followers(){
        return view('businessusers.profiles.followers');
    }

    public function edit(){
        return view('businessusers.profiles.edit');
    }

    public function reviews(){
        return view('businessusers.reviews.allreviews');
    }

    public function showreview(){
        return view('businessusers.reviews.showreview');
    }

    public function promotion_create(){
        return view('businessusers.posts.promotions.create');
    }

    public function promotion_edit(){
        return view('businessusers.posts.promotions.edit');
    }

}
