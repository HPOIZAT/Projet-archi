<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::get();

        if ($users->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => __('No user found')
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
    }

    public function show($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('User not found')
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function store() {
        $data = request()->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone_number' => 'required|phone|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['status'] = 'ACTIVE';

        $user = User::create($data);
        $created = $user->save();

        if (!$created) {
            return response()->json([
                'success' => false,
                'message' => __('User not created')
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 201);
    }

    public function update($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('User not found')
            ], 404);
        }

        $data = request()->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone_number' => 'required|phone|unique:users,phone_number,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required',
        ]);

        $data['password'] = bcrypt($data['password']);

        $updated = $user->update($data);

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => __('User not updated')
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    // Hard Delete
    public function destroy($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('User not found')
            ], 404);
        }

        $deleted = $user->delete();

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => __('User not deleted')
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => __('User deleted')
        ], 200);
    }

    // Soft delete
    public function delete() {
        $users = User::get();

        if ($users->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => __('No user found')
            ], 400);
        }

        $users->stetatus('DELETED');
        $deleted = $users->save();

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => __('Users not deleted')
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => __('Users deleted')
        ], 200);
    }
}
