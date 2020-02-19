<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\tag;
use App\Http\Requests\tagrequest;
class tagControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=tag::all();
        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(tagrequest $request)
    {
        tag::create($request->all());
        session()->flash('success','category added successfuly');

               // return redirect('categories');
            //alert()->success('aded with success!');
            toast('aded with success!','success');

            return redirect ('tags');
              // ->with('success','aded with success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(tag $tag)
    {
        return view('tags.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(tag $tag)
    {
        return view('tags.create',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(tagrequest $request, tag $tag)
    {
        $tag->update([
        'name'=>$request->name
]);
toast('data updated! ', 'success');
        session()->flash('success','category updated successfuly');
        return redirect('tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(tag $tag)
    {
        $tag->delete();
        toast('Welcome back!', 'success');

        return back()->with('success','Post deleted successfully');
    }
}
