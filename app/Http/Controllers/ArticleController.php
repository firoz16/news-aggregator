<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/**
 * @OA\Info(
 *     title="News Aggregator API",
 *     version="1.0.0",
 *     description="API for aggregating news articles from various sources.",
 *     termsOfService="https://example.com/terms/",
 *     contact={
 *         "email": "support@example.com"
 *     },
 *     license={
 *         "name": "MIT",
 *         "url": "https://opensource.org/licenses/MIT"
 *     }
 * )
 */
class ArticleController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/articles",
     *     summary="Get all articles",
     *     tags={"Articles"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of articles",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Article"))
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
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

     /**
     * @OA\Get(
     *     path="/api/articles/{id}",
     *     summary="Get a single article by ID",
     *     tags={"Articles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the article",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article details",
     *         @OA\JsonContent(ref="#/components/schemas/Article")
     *     ),
     *     @OA\Response(response=404, description="Article not found")
     * )
     */

    public function show($id) {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }

    public function fetch(){
        Artisan::call('fetch:articles');

        return response()->json(['message'=>'Articles are being fetched.']);
    }
}
