<?php

namespace App\Http\Controllers;

use App\Models\Book_Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Book_AuthorController extends Controller
{
    // Tampilkan semua relasi buku-penulis
    public function index(): JsonResponse
    {
        $data = Book_Author::with(['book', 'author'])->get();
        return response()->json($data, 200);
    }

    // Tampilkan satu relasi berdasarkan ID
    public function show($id): JsonResponse
    {
        try {
            $relation = Book_Author::with(['book', 'author'])->findOrFail($id);
            return response()->json($relation, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Relasi Book-Author tidak ditemukan.'], 404);
        }
    }

    // Tambahkan relasi baru
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'book_id' => 'required|string|exists:books,id',
            'author_id' => 'required|string|exists:authors,id',
        ]);

        $relation = Book_Author::create([
            'book_id' => $request->book_id,
            'author_id' => $request->author_id,
        ]);

        return response()->json([
            'message' => 'Relasi Book-Author berhasil ditambahkan.',
            'data' => $relation
        ], 201);
    }

    // Update relasi
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $relation = Book_Author::findOrFail($id);

            $request->validate([
                'book_id' => 'sometimes|string|exists:books,id',
                'author_id' => 'sometimes|string|exists:authors,id',
            ]);

            $relation->update($request->only(['book_id', 'author_id']));

            return response()->json([
                'message' => $relation->wasChanged()
                    ? 'Relasi berhasil diperbarui.'
                    : 'Tidak ada perubahan.',
                'data' => $relation
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Relasi Book-Author tidak ditemukan.'], 404);
        }
    }

    // Hapus relasi
    public function destroy($id): JsonResponse
    {
        try {
            $relation = Book_Author::findOrFail($id);
            $relation->delete();

            return response()->json(['message' => 'Relasi berhasil dihapus.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Relasi Book-Author tidak ditemukan.'], 404);
        }
    }
}
