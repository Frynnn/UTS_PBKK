<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {

        $dataAuthor = Author::all();
        return response()->json($dataAuthor, 200);
    }

    public function show($id): JsonResponse
    {
        try {
            $author = Author::findOrFail($id);
            return response()->json($author, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Author tidak ditemukan'], 404);
        }
    }

    // Menambahkan author baru
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:100',
            'birthdate' => 'required|date',
        ]);

        $author = Author::create([
            'name' => $request->name,
            'nationality' => $request->nationality,
            'birthdate' => $request->birthdate,
        ]);


        return response()->json([
            'message' => 'Author berhasil ditambahkan.',
            'data' => $author
        ], 201);
    }

      // Mengupdate data user
      public function update(Request $request, $id): JsonResponse
      {
          try {
              $author = Author::findOrFail($id);
  
              $request->validate([
                'name' => 'sometimes|string|max:255',
                'nationality' => 'sometimes|string|max:100',
                'birthdate' => 'sometimes|date',
            ]);
  
              // Hanya update field yang dikirim
              $data = $request->only(['name', 'nationality', 'birthdate']);

              $author->update($data);
  
              return response()->json([
                  'message' => $author->wasChanged()
                      ? 'Data author berhasil diupdate.'
                    : 'Tidak ada perubahan pada data author.',
                  'data' => $author
              ], 200);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Data author tidak ditemukan'], 404);
          }
      }
  
      public function destroy($id): JsonResponse
      {
          try {
              $author = Author::findOrFail($id);
              $author->delete();
  
              return response()->json(['message' => 'Data author berhasil dihapus.']);
          } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Data author tidak ditemukan.'], 404);
          }
      }
}