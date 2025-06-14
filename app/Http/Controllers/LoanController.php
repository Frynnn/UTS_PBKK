<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoanController extends Controller
{
    // Tampilkan semua data peminjaman
    public function index(): JsonResponse
    {
        $loans = Loan::with(['user', 'book'])->get(); // Menampilkan relasi user & book
        return response()->json($loans, 200);
    }

    // Tampilkan 1 data peminjaman berdasarkan ID
    public function show($id): JsonResponse
    {
        try {
            $loan = Loan::with(['user', 'book'])->findOrFail($id);
            return response()->json($loan, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data loan tidak ditemukan.'], 404);
        }
    }

    // Simpan data peminjaman baru
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|string|exists:users,id',
            'book_id' => 'required|string|exists:books,id',
        ]);

        $loan = Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
        ]);

        return response()->json([
            'message' => 'Data loan berhasil ditambahkan.',
            'data' => $loan
        ], 201);
    }

    // Perbarui data peminjaman
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $loan = Loan::findOrFail($id);

            $request->validate([
                'user_id' => 'sometimes|string|exists:users,id',
                'book_id' => 'sometimes|string|exists:books,id',
            ]);

            $loan->update($request->only(['user_id', 'book_id']));

            return response()->json([
                'message' => $loan->wasChanged() 
                    ? 'Data loan berhasil diperbarui.' 
                    : 'Tidak ada perubahan pada data loan.',
                'data' => $loan
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data loan tidak ditemukan.'], 404);
        }
    }

    // Hapus data peminjaman
    public function destroy($id): JsonResponse
    {
        try {
            $loan = Loan::findOrFail($id);
            $loan->delete();

            return response()->json(['message' => 'Data loan berhasil dihapus.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data loan tidak ditemukan.'], 404);
        }
    }
}
