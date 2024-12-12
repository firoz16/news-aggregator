<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    // Store user preferences
    public function store(Request $request)
    {
        $request->validate([
            'source' => 'required|string',
            'category' => 'required|string',
            'author' => 'required|string',
        ]);

        $user = Auth::user();

        $preference = new UserPreference([
            'source' => $request->source,
            'category' => $request->category,
            'author' => $request->author,
        ]);

        // Associate the preference with the authenticated user
        $user->preferences()->save($preference);

        return response()->json(['message' => 'Preferences saved successfully'], 200);
    }

    // Get user preferences
    public function show()
    {
        $user = Auth::user();
        return response()->json($user->preferences);
    }
}
