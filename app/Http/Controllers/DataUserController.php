<?php

namespace App\Http\Controllers;

//import Model Post
use App\Models\Post;
use App\Models\User;

//return type view
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\Request;

//import Facade "Storage"
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class DataUserController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $User = User::latest()->paginate(5);

        //render view with posts
        return view('dashboard', compact('User'));

    }

    public function user(): View
    {
        $User = Auth::user();
        return view('table_user', compact('User'));
    }
}
