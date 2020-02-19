<?php
namespace App\Http\Controllers;
use App\Http\Requests\postrequest;
use App\Http\Requests\update_post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Post;
use\App\Category;
use\App\tag;
class postcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=post::all();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',category::all())->with('tags',tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(postrequest $request)
    {
       // dd($request->all());
        $post=post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$request->image->store('images','public'),
            'category_id'=>$request->categoryID,
            'user_id'=>$request->user_id
        ]);
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        //dd($request->image->store('images','public'));
        toast()->success('aded with success!');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        $user=$post->user;
        $profile=$user->profile;
        return view ('posts.show',['post'=>$post,'categories'=>category::all(),'profile'=>$profile,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
       // dd($post->tags->pluck('id')->toArray());
        //return view('posts.create')->with('post',$post)->with('categories',category::all());
        return view('posts.edit',['post'=>$post,'categories'=>category::all(),'tags'=>tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(update_post $request, post $post)
    {


        $data=$request->only([
            'title','description','content'
        ]);
        if($request->hasFile('image')){
            $image=$request->image->store('images','public');
            storage::disk('public')->delete($post->image);
            $data['image']=$image;
        }
        if ($request->tags){
            //$post->tags()->sync([7,8,9,10]);
            $post->tags()->sync($request->tags);
        }

        $post->update($data);
        toast('updated with success','success');
        return redirect('posts');
/*

$data = $request->only(['title', 'description', 'content']);
    if ($request->hasFile('image')) {
      $image = $request->image->store('images', 'public');
      Storage::disk('public')->delete($post->image);
      $data['image'] = $image;
    }

    if ($request->tags) {
      $post->tags()->sync($request->tags);
    }

    $post->update($data);

    toast()->success('updated with success!');
    return redirect(route('posts.index'));
    */
  }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        /*
        $post->delete();
        toast('trushed with success','success');
        return redirect('posts');*/
        //dd($post::onlyTrashed()->get());

        $post=post::withTrashed()->where('id',$id)->first();
        if($post->trashed()){
        $post->forceDelete();
        Storage::disk('public')->delete($post->image);
        toast('trushed with success','success');
        return redirect('trushed-post');
        }
        else{
            $post->delete();
            toast('trushed with success','success');
            return redirect('posts');
        }

    }

    public function trushed(){
        $trushed=post::onlyTrashed()->get();
        //return view('posts.index')->with('posts',$trushed);
        return view('posts.index')->withPosts($trushed);
    }
    public function restore($id){
post::withTrashed()->where('id',$id)->restore();
toast('trushed with success','success');
return redirect('posts');
}
public function __construct()
{
    $this->middleware('checkCategory')->only('create');
}
}
