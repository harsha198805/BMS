<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Tag;
use App\Task;
use Illuminate\Support\Carbon;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data['categories']=Project::orderBy('id','desc')->get();

      $post_query=Task::with('user')->where('user_id',auth()->id());
    
      if($request->project){
        $post_query->whereHas('project',function($q) use ($request){
         $q->where('name',$request->project);
        });
      }

      if($request->keyword){
       $post_query->where('title','LIKE','%'.$request->keyword.'%');
      }

      $data['books']=$post_query->orderBy('id','DESC')->paginate(10);
      return view('post.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
       $data['categories']=Project::orderBy('id','desc')->get();
       $data['tags']=Tag::orderBy('id','desc')->get();
       return view('post.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
         'category'=>'required'
        ]);

        $post=Task::create([
         'user_id'=>auth()->id(),
         'project_category_id'=>$request->category,
         'start_time' =>Carbon::now(),
         'end_time' =>Carbon::now(),
        ]);
        
        return redirect()->route('books.index')->with('success','Task successfully asign');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['post']=$post=Task::findOrFail($id);

        // if($post->user_id !=auth()->id()){
        //  abort(403);
        // }

      // $this->authorize('view', $post);
       return view('post.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      
       $data['post']=$post=Task::findOrFail($id);
         $this->authorize('update', $post);

       $data['categories']=Project::orderBy('id','desc')->get();
       $data['tags']=Tag::orderBy('id','desc')->get();
       return view('post.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



        $post=Task::findOrFail($id);

             $this->authorize('update', $post);
         $request->validate([
         'title'=>'required|max:255',
         'author_name'=>'required|max:255',
         'description'=>'required',
         'image'=>'nullable|mimes:jpeg,jpg,png',
         'category'=>'required',
         'tags'=>'required|array'
        ],[
         'category.required'=>'Please select a category.',
         'tags.required'=>'Please select atlest one tag.'
        ]);


        if($request->hasFile('image')){

            $image=$request->file('image');

            $image_name=time().'.'.$image->extension();
            $image->move(public_path('post_images'),$image_name);

            $old_path=public_path().'post_images/'.$post->image;

            if(\File::exists($old_path)){
             \File::delete($old_path);
            }

        }else{
           $image_name =$post->image;
        }

        $post->update([
         'title'=>$request->title,
         'author_name'=>$request->author_name,
         'description'=>$request->description,
         'image'=>$image_name,
         'user_id'=>auth()->id(),
         'category_id'=>$request->category
        ]);

        $post->tags()->sync($request->tags);

        return redirect()->route('books.index')->with('success','Book successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $post=Task::findOrFail($id);
     $this->authorize('delete', $post);
         $old_path=public_path().'post_images/'.$post->image;

        if(\File::exists($old_path)){
         \File::delete($old_path);
        }

        $post->delete();


        return redirect()->route('books.index')->with('success','Book successfully deleted.');
    }
}
