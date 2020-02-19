<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\categoryrequest;
use App\category;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
class categorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=category::all();
        if($categories->count()==0){
            // example:
          //  toast('Title','Lorem Lorem Lorem', 'success')->padding('50px');
           toast('No Categories yet','error')->position('center-center')->autoClose(5000)->hideCloseButton()->background('rgba(123,145,234,0.4)');
        // example:

        }
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categoryrequest $request)
    {

                /*
$data=new category();
$data->name=$request->get('name');
$data->save();
*/
            category::create($request->all());
             session()->flash('success','category added successfuly');

               // return redirect('categories');
            //alert()->success('aded with success!');
            toast('aded with success!','success');

            return redirect ('categories');
              // ->with('success','aded with success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        /*
        $category=category::find($id);
        return view('categories.create',compact('category'));
        */
        return view('categories.create',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(categoryrequest $request,category $category)
    {
/*
        $request->validate([
            'name'=>'required|string|max:255|min:4|unique:categories'
        ]);
        $category=category::find($id);
        $category->name=$request->name;
        $category->save();
        */
        $category->update(['name'=>$request->name]);
        toast('data updated! ', 'success');
        session()->flash('success','category updated successfuly');
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( category $category)
    {
        /*
        alert()->flash('Are you sure?', 'warning',[
            'text' => 'You won\'t be able to revert this!',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            // if user clicked Yes, delete it!
            // then this will run
            'deleted' => 'Deleted!',
            'msg' => 'Your file has been deleted.',
            'type' => 'success'
        ]);
*/

            //$category=category::find($id);
            $category->delete();
           return back()->with('success','Post deleted successfully');
           toast('Welcome back!', 'success');


      //  return redirect("/categories");
      //  $id->delete();
       // session()->flash('delete','delete successfully');
       //return redirect('/todos')->with('status','delete successfully');
       // example:
      // toast()->warning('Data deleted!');
       // example:
       session()->flash('warning','delete successfully');

      // return redirect()->back()->with('toast', 'Deleted!');
       return redirect('categories');

    }
}
