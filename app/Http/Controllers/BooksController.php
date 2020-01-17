<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Tutornia\Http\Resources\BookResource;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $books = [];
        $page = request('page') || 1;
        $size = request('size') || 10;

        if ($page) {
            $books = Book::with('review')->paginate($page, $size);
        }

        if (request('sortColumn') && request('sortColumn') == 'title') {
            $books = Book::with('review')->sortBy('title', request('sortDirection'))->paginate($page, $size)->get();
        }

        if (request('sortColumn') && request('sortColumn') == 'avg_review') {
            $books = Book::with('review')->sortBy('title', request('sortDirection'))->paginate($page, $size)->get();
        }

        if (request('title')) {
            $searchTerm = request('title');
            $books = Book::with('review')->where('title', 'LIKE', "%{$searchTerm}%")->paginate($page, $size)->get();
        }

        if (request('authors')) {
            $searchTerm = request('authors');
            $books = Book::with('review')->whereIn('author_id', $searchTerm)->paginate($page, $size)->get();
        }

        return BookResource::collection($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->is_admin == 1) {
            return Book::create($request->all());
        } else {
            return "401: request unauthorized";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new BookResource(Book::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // RUN VALIDTION HERE

        if (auth()->user()->is_admin == 1) {
            $book = Book::findOrFail($id);

            $book->update($request->all());

            return new BookResource($book);
        } else {

            // PUT IN A BETTER JSON MESSAGE
            return response()->json();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->is_admin == 1) {
            $book = Book::findOrFail($id);
            $book->delete();

            return 204;
        } else {
            // PUT IN A BETTER JSON MESSAGE
            return response()->json();
        }
    }
}
