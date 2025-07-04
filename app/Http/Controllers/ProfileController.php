<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index');
    }

    public function edit() {
        return view('profile.edit');
    }

    public function update(Request $request, UpdateUserProfileInformation $updater) {
        $updater->update(auth()->user(), $request->only('name', 'email'));
        return response()->json([
            'status' => 'success'
        ]);
    }
}
