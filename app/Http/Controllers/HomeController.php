<?php

namespace App\Http\Controllers;

use index;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{



    public function index() : View
    {
        //get all products
        $posts = post::latest()->paginate(5);
        $maleCount = post::where('kelamin', 'laki-laki')->count();
        $femaleCount = post::where('kelamin', 'perempuan')->count();

        //render view with products
        return view('admin.dashboard', compact('posts', 'maleCount', 'femaleCount'));
    }

    /**
     * open data pegawai
     *
     * @return View
     */
    public function data_pegawai(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('admin.data_pegawai', compact('posts'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.create');
    }



    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $validation = $request->validate([
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'     => 'required|min:3',
            'alamat'   => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir' => 'required',
            'kelamin' => 'required',
            'jabatan'  => 'required',
            'tgl_masuk' => 'required',
            'jobdesc' => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        //create post
        Post::create([
            'image'     => $image->hashName(),
            'nama'     => $request->nama,
            'alamat'   => $request->alamat,
            'tempat_lahir'      => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'kelamin'     => $request->kelamin,
            'jabatan'       => $request->jabatan,
            'tgl_masuk'     => $request->tgl_masuk,
            'jobdesc'       => $request->jobdesc

        ]);

        //redirect to index
        return redirect('admin/data_pegawai')->with(['success' => 'Data Berhasil Disimpan!']);
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
        return view('admin.show', compact('post'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get product by ID
        $post = Post::findOrFail($id);

        //render view with product
        return view('admin.edit', compact('post'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $validation = $request->validate([
            'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama'     => 'required|min:2',
            'alamat'   => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir' => 'required',
            'kelamin' => 'required',
            'jabatan'  => 'required',
            'tgl_masuk' => 'required',
            'jobdesc' => 'required'
        ]);

        //get product by ID
        $post = Post::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/' . $post->image);

            //update product with new image
            $post->update([
                'image'     => $image->hashName(),
                'nama'     => $request->nama,
                'alamat'   => $request->alamat,
                'tempat_lahir'      => $request->tempat_lahir,
                'tgl_lahir'     => $request->tgl_lahir,
                'kelamin'     => $request->kelamin,
                'jabatan'       => $request->jabatan,
                'tgl_masuk'     => $request->tgl_masuk,
                'jobdesc'       => $request->jobdesc
            ]);

        } else {

            //update product without image
            $post->update([
                'nama'     => $request->nama,
                'alamat'   => $request->alamat,
                'tempat_lahir'      => $request->tempat_lahir,
                'tgl_lahir'     => $request->tgl_lahir,
                'kelamin'     => $request->kelamin,
                'jabatan'       => $request->jabatan,
                'tgl_masuk'     => $request->tgl_masuk,
                'jobdesc'       => $request->jobdesc
            ]);
        }

        //redirect to index
        return redirect('admin/data_pegawai')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $post = Post::findOrFail($id);

        //delete image
        Storage::delete('public/posts/' . $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect('admin/data_pegawai')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
