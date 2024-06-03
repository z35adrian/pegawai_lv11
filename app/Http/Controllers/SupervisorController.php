<?php

namespace App\Http\Controllers;

use index;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SupervisorController extends Controller
{
    public function index() : View
    {
        //get all products
        $posts = post::latest()->paginate(5);
        $maleCount = post::where('kelamin', 'laki-laki')->count();
        $femaleCount = post::where('kelamin', 'perempuan')->count();

        //render view with products
        return view('supervisor.dashboard', compact('posts', 'maleCount', 'femaleCount'));
    }


     /**
     * open data pegawai
     *
     * @return View
     */
    public function data_pegawai(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('supervisor.data_pegawai', compact('posts'));
    }


        /**
         * show
         *
         * @param  mixed $id
         * @return View
         */
        public function show(string $id): View
        {
            //get post by ID
            $post = Post::findOrFail($id);

            //render view with post
            return view('supervisor.show', compact('post'));
        }
}

