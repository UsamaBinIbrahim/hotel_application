<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    function index() {
        return view('profile.favorites.index');
    }
}
