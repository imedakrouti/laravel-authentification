<?php

namespace App\Http\Controllers;
use App\user;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class usercontroller extends Controller
{
    public function index(){
        return view('users.index',['users'=>user::all()]);
    }
    public function create(){
        return view('users.create');
    }
    public function makeAdmin($id){
        $user=user::find($id);
        //$cateugory->update(['name'=>$request->name]);
       $user->role='admin';
      $user->save();
       return redirect('users');
    }
    public function makeWriter( $user){
       // $user=user::find($id);

      DB::table('users')->where('id', $user)->update(['role'=>'writer']);
       return redirect('users');
    }
    public function profile(user $user){

        //return view('users.profile')->with('user',$user);
        $profile = $user->profile;
        return view('users.profile', ['user' => $user, 'profile' => $profile]);
    }

      public function update(User $user, Request $request) {
        $profile = $user->profile;
        $data = $request->all();
        if ($request->hasFile('picture')) {
          $picture = $request->picture->store('profilesPicture', 'public');
          $data['picture'] = $picture;
        }
        $profile->update($data);
        return redirect(route('home'));
      }
}
