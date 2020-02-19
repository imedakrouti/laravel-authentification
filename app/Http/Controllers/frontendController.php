<?php

namespace App\Http\Controllers;
use App\post;
use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class frontendController extends Controller
{
    public function index(){
        $search=request()->query('search');
        if($search){
             // dd(post::where('title','like',$search)->get()) ;
             
            $posts=post::where('title','like',"%{$search}%")->paginate(1);
             // dd($search);
        }
    //  dd(post::where('name','like',$serch)->get()) ;
         //   $posts=post::find(1);
             // dd($search);
       else {
        $posts=post::paginate(1);
       }
       
         
        $categories=category::all();
        return view('welcome',compact('categories','posts'));

    }
}
