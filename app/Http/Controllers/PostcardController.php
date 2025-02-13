<?php

namespace App\Http\Controllers;

use App\Models\Postcard;
use Illuminate\Http\Request;

class PostcardController extends Controller
{
    public function create()
    {
        return inertia('Postcard/Create');
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
            'postcard' => $postcard
        ]);
    }
}
