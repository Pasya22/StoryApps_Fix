<?php

namespace App\Http\Controllers\home;

use App\Models\adminModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class writterController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function writter()
    {
        if (Auth::user()->id_role !== 2) {
            return redirect()->route('StoryApps')->withErrors("You don't have permission to access this page");
        } else {
            return view('home.writter.dashboard');
        }
    }
    public function registerWriter()
    {
        return view('home.writter.registerWriter');
    }
    public function postRegistion(Request $request)
    {
        $validation = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'phone_number' => 'required|unique:users,phone_number',
            'password' => 'required|min:6|max:12',
            // 'password_confirmation' => 'required|same:password',
        ], [
            'full_name.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan',
            'phone_number.required' => 'Nomor telepon harus diisi.',
            'phone_number.unique' => 'Nomor telepon sudah digunakan',
            'password.required' => 'Silakan masukkan kata sandi.',
            'password.min' => 'Kata sandi harus memiliki minimal :min karakter',
            'password.max' => 'Kata sandi tidak boleh lebih dari :max karakter',
            'password_confirmation.required' => 'Silakan konfirmasi kata sandi.',
            'password_confirmation.same' => 'Konfirmasi kata sandi harus sama dengan kata sandi',
        ]);

        $data = array_merge($validation, [
            'password' => bcrypt($validation['password']),
            'created_at' => now('Asia/Jakarta'),
            'id_role' => 3,
            'image_user' => 'default.png'
        ]);

        if (adminModel::createData('users', $data) == true) {
            return redirect()->route('writter')->with('success', 'Register Succesfully, You can Login Now!');
        } else {
            return redirect()->route('registerWriter')->with('failed', 'User not added');

        }

    }
    public function profile($id)
    {
        $data['user'] = adminModel::getDataById('users', 'id', $id);
        $data['genre'] = adminModel::getData('genre');
        // dd($data);

        return view("home.profile", compact('data'));
    }
    // public function send(Request $request)
    // {

    //     $comment = [
    //         'id' => $request->input('id'),
    //         'id_story' => $request->input('id_story'),
    //         'rate' => $request->input('rate'),
    //         'status' => $request->input('status'),
    //         'comment' => $request->input('comment')

    //     ];
    //     $execute = adminModel::CreateData('rates', $comment);
    //     if ($execute == true) {
    //         // session()->flash('notification', 'New comment received!');
    //         return redirect('/')->with('success', "Comment Successfully");
    //     } else {
    //         return back()->withInput()->withErrors(['error', 'Please fill in all fields']);
    //     }

    // }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
