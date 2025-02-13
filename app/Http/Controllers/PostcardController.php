<?php

namespace App\Http\Controllers;

use App\Models\Postcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PostcardController extends Controller
{
    public function create()
    {
        return inertia('Postcard/Create', [
            'postcard' => new Postcard,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'street_1' => 'required|string|max:255',
            'street_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);

        $validate['user_id'] = auth()->user()->id;

        $postcard = Postcard::create($validate);

        return to_route('postcards.show', $postcard)->banner('Postcard created successfully');
    }

    public function show(Postcard $postcard)
    {
        return inertia('Postcard/Show', [
            'postcard' => $postcard,
        ]);
    }

    public function copyLink(Postcard $postcard)
    {
        // signed url for anonymous users
        $signedUrl = URL::signedRoute('postcards.shared', $postcard);

        return response()->json(['url' => $signedUrl]);
    }

    public function shared(Postcard $postcard)
    {
        return inertia('Postcard/Shared', [
            'postcard' => $postcard,
        ]);
    }

    public function uploadFile(Postcard $postcard, Request $request)
    {
        $validate = $request->validate([
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_text' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $validate['file']->store('postcards', 'public');
            $postcard->file = $validate['file']->hashName();
        }

        if ($request->has('cover_text')) {
            $postcard->cover_text = $validate['cover_text'];
        }

        $postcard->save();

        return back()->banner('Postcard updated successfully');
    }
}
