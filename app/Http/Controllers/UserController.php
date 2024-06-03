<?php

namespace App\Http\Controllers;

use index;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    public function table_user(): View
    {
        $user = Auth::user();
        return view('table_user', compact('user'));
    }

    /**
     * create
     *
     * @return View
     */
    public function data_user(): View
    {
        $users = User::latest()->paginate(5);

        return view('admin/userdata/data_user', compact('users'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.userdata.create');
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
            'name'     => 'required|min:3',
            'email'   => 'required',
            'usertype'  => 'required',
            'password' => 'required'
        ]);

        //create post
        User::create([
            'name'     => $request->name,
            'email'   => $request->email,
            'usertype'      => $request->usertype,
            'password'     => $request->password
        ]);

        //redirect to index
        return redirect('admin/userdata/data_user')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $user = User::findOrFail($id);

        //render view with post
        return view('admin.userdata.show', compact('user'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $user = User::findOrFail($id);

        //render view with post
        return view('admin.userdata.edit', compact('user'));

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
            'name'     => 'required|min:3',
            'email'   => 'required',
            'usertype'  => 'required',
            'password' => 'required'
        ]);

        //get post by ID
        $user = User::findOrFail($id);

            //update post with new image
            $user->update([
                'name'     => $request->name,
                'email'   => $request->email,
                'usertype'      => $request->usertype,
                'password'     => $request->password

            ]);


        //redirect to index
        return redirect('admin/userdata/data_user')->with(['success' => 'Data Berhasil Diubah!']);
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
        $user = User::findOrFail($id);

        //delete post
        $user->delete();

        //redirect to index
        return redirect('admin/userdata/data_user')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
