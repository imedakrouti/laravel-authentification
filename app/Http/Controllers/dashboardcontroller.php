<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\post;
use App\category;
class dashboardcontroller extends Controller
{
    public function index(){
        return view('dashboard.index',['post_count'=>post::all()->count(),'user_count'=>user::all()->count(),'category_count'=>category::all()->count()]);
    }
}
