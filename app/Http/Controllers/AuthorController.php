<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return AuthorResource::collection($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request, Author $author)
    {
        $validated = $request->validated();
        $checkAuthor = $author->isExist($validated['name']);
        if ($checkAuthor) {
            return response()->json(["message" => "author_is_existed"]);
        }

        Author::created($validated);
        return response()->json(null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required'
        ]);

        $author->update($request->all());

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
