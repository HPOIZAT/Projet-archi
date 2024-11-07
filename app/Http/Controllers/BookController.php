<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Book::get();

        if ($books->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => __('No book found')
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $books
        ], 200);
    }

    public function show($id) {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => __('Book not found')
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $book
        ], 200);
    }

    public function store() {
        $data = request()->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'category' => 'required|string',
            'publication_date' => 'required|date',
            'isbn' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string'
        ]);

        $book = Book::create($data);
        $created = $book->save();

        if (!$created) {
            return response()->json([
                'success' => false,
                'message' => __('Book not created')
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $book
        ], 201);
    }

    public function destroy($id) {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => __('Book not found')
            ], 404);
        }

        $deleted = $book->delete();

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => __('Book not deleted')
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => __('Book deleted')
        ], 200);
    }
}
