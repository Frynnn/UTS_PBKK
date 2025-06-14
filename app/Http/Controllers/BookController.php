<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    public function index(): JsonResponse
    {

        $dataBook = Book::all();
        return response()->json($dataBook, 200);
    }

    public function show($id): JsonResponse
    {
        try {
            $book = Book::findOrFail($id);
            return response()->json($book, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Book tidak ditemukan'], 404);
        }
    }

    // Menambahkan author baru
    public function store(Request $request): JsonResponse
    {
        $request->validate([
           'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:20',
            'publisher' => 'required|string|max:100',
            'year_published' => 'required|string|max:4',
            'stock' => 'required|integer|min:0',
        ]);

        $book = Book::create([
               'title' => $request->title,
            'isbn' => $request->isbn,
            'publisher' => $request->publisher,
            'year_published' => $request->year_published,
            'stock' => $request->stock,
        ]);


        return response()->json([
            'message' => 'Book berhasil ditambahkan.',
            'data' => $book
        ], 201);
    }

      // Mengupdate data user
      public function update(Request $request, $id): JsonResponse
      {
          try {
              $book = Book::findOrFail($id);
  
              $request->validate([
                'title' => 'sometimes|string|max:255',
                'isbn' => 'sometimes|string|max:20',
                'publisher' => 'sometimes|string|max:100',
                'year_published' => 'sometimes|string|max:4',
                'stock' => 'sometimes|integer|min:0',
            ]);
  
              // Hanya update field yang dikirim
              $data = $request->only(['title', 'isbn', 'publisher', 'year_published', 'stock']);

              $book->update($data);
  
              return response()->json([
                  'message' => $book->wasChanged()
                      ? 'Data book berhasil diupdate.'
                    : 'Tidak ada perubahan pada data book.',
                  'data' => $book
              ], 200);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Data book tidak ditemukan'], 404);
          }
      }
  
      public function destroy($id): JsonResponse
      {
          try {
              $book = Book::findOrFail($id);
              $book->delete();
  
              return response()->json(['message' => 'Data book berhasil dihapus.']);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Data book tidak ditemukan.'], 404);
          }
      }
}