<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $articles=Article::latest()->paginate(5);     //latest -orderBy created at descending

        return view('articles.list',compact('articles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'required|min:5',
            'text' => 'nullable|string|max:255',
            'author' => 'required||min:3'

        ]);

        if ($validator->passes()) {

            Article::create([

                "title" => $request->title,
                "text" => $request->title,
                "author" => $request->title


            ]);
            return redirect()->route('articles.index')->with('success', 'An Article added ');
        } else {
            return redirect()->route('articles.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
