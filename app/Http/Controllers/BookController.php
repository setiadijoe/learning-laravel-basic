<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        Book::insert($request->all()+[
            'id' => Uuid::uuid4()
        ]);

        return response()->json(null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, Category $category, Author $author)
    {
        $request->validate([
            'description' => 'bail|required',
            'status' => 'bail|required'
            ]);

        // dd($request->all());
        // $categoryCheck = $category->checkCategory($request->category_id);
        // if(!$categoryCheck){
        //     return response()->json(["message" => "category_unknown"], 422);
        // }

        // $authorCheck = $author->checkAuthor($request->author_id);
        // if(!$authorCheck){
        //     return response()->json(["message" => "author_unknown"], 422);
        // }

        // $checkIfExisting = $book->isExist($request->category_id, $request->author_id, $request->title);
        // if($checkIfExisting){
        //     return response()->json(["message" => "book_is_exists"], 422);
        // }

        $book->update($request->all());

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
