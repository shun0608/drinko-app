<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        $this->deleteOldUserIfExists($request->email);

        $new_user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($new_user);

        return response()->json(['created' => true], Response::HTTP_OK);
    }

    /**
     * Delete the old user if exists.
     */
    protected function deleteOldUserIfExists(string $email): void
    {
        $oldUser = User::withTrashed()->where('email', $email)->first();

        if ($oldUser) {
            $oldUser->forceDelete();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = Auth::user();
        if (! $user) {
            return response()->json('ユーザーが見つかりません。', 404);
        }
        $user->tokens()->delete();
        $request->session()->invalidate();
        $user->delete();

        return response()->json('ユーザーの削除が完了しました。');
    }
}
