<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        foreach ($articles as $article) {
        $article->image_url = asset('storage/' . $article->image_path);
        }
        return response()->json($articles);

    }
    public function home()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('index', compact('articles'));
    }

    public function create()
    {
        
        return view('create');
    }
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('edit', compact('article'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $articleData = $request->except('image'); 
        $article = Article::create($articleData);
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store the image in the public storage directory
            $article->image_path = $imagePath;
            $article->save();
        }
        return response()->json($article, 201);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->image_url = asset('storage/' . $article->image_path);
        return response()->json($article);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $article = Article::findOrFail($id);
        $article->fill($request->except('image')); 

        // Handle image update if a new image is uploaded
        if ($request->hasFile('image')) {
            
            $imagePath = $request->file('image')->store('images', 'public'); 
            $article->image_path = $imagePath;
        }

        $article->save();

        return response()->json($article, 200);
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(null, 204);
    }
}

