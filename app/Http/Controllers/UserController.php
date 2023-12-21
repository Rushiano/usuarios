<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:3|max:50',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6|max:20'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::create($validator->validated());

            return response()->json(['message' => 'Usuário criado com sucesso', 'user' => $user], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
                'old' => $request->all(),
            ], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function show()
    {
        return view('list');
    }
    public function list()
    {
        try {
            $response = User::all();
            return response()->json(['users' => $response], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
