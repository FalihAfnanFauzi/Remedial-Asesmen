<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cek Credential
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal: Email atau Password salah.'
            ], 401);
        }

        // 3. Ambil Data User & Buat Token
        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Return JSON (Respon Sukses)
        return response()->json([
            'success' => true,
            'message' => 'Hi ' . $user->name . ', Selamat Datang!',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    public function logout()
    {
        // Hapus token saat ini (Logout)
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Logout'
        ]);
    }
}