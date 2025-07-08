<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller 
{
  public function __construct()
    {
        $this->middleware('permission:view articles')->only('index');
        $this->middleware('permission:edit articles')->only('edit', 'update');
        $this->middleware('permission:create articles')->only('create', 'store');
        $this->middleware('permission:delete articles')->only('destroy');
    }

    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('articles.list', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'text' => 'nullable|string|max:255',
            'author' => 'required|min:3',
        ]);

        if ($validator->passes()) {

            
            Article::create([

                "title"=>$request->title ,    
                "text"=>$request->text, 
                "author"=>$request->author ,     

            ]);
            // Article::create($request->only(['title', 'text', 'author']));
            return redirect()->route('articles.index')->with('success', 'An Article added');
        } else {
            return redirect()->route('articles.create')->withInput()->withErrors($validator);
        }
    }

    public function show(Article $article)
    {
        // return view('articles.show', compact('article'));
    }

    public function edit($id)

    {
         $articles=Article::findorFail($id);

        return view('articles.edit', compact('articles'));
    }

    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:articles,title,' . $article->id,
            'text' => 'nullable|string|max:255',
            'author' => 'required|min:3'
        ]);

        if ($validator->passes()) {
            // $article->update($request->only(['title', 'text', 'author']));
            return redirect()->route('articles.index')->with('success', 'Article updated successfully');
        } else {
            return redirect()->route('articles.edit', $article->id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request){
    $id=$request->id;

   $article= Article::find($id);


   if($article==null){
    session()->flash('error','article not found');
    return response()->json([
                                            //used ajax 
        'status'=>false   
    ]);

   }

   $article->delete();

   session()->flash('success','article  deleted');
   return response()->json([
                                        
       'status'=>true  
   ]);

}
}