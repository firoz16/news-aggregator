<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Article",
 *     type="object",
 *     required={"id", "title", "content", "published_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Sample Article Title"),
 *     @OA\Property(property="content", type="string", example="Content of the article"),
 *     @OA\Property(property="author", type="string", example="author of the article"),
 *    @OA\Property(property="source", type="string", example="source of the article"),
 *     @OA\Property(property="published_at", type="string", format="date-time", example="2024-12-11T12:00:49Z")
 * )
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','content','author','source','description','published_at'
    ];
}
