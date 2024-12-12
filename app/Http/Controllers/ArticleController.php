<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArticleController extends Controller
{

    public function index(Request $request) {
        $query = Article::query();

        if ($request->has('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        if ($request->has('source')) {
            $query->where('source', $request->source);
        }

        $articles = Article::paginate(10);
        if(count($articles) > 0){
            return response()->json($articles);
        }else{
            return response()->json(['message'=>'No Data Found!']);
        }
    }


    public function show($id) {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }

    public function fetch(){
        Artisan::call('fetch:articles');

        return response()->json(['message'=>'Articles are being fetched.']);
    }
}
