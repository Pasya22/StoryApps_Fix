<?php
// LoginController.php
namespace App\Http\Controllers;

use App\Models\adminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'StoryApps']);
    }

    public function registerUser()
    {
        return view('Auth.Register');
    }

    public function regisUser(Request $request)
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
            'active' => 0,
            'image_user' => 'default.png'
        ]);

        if (adminModel::createData('users', $data) == true) {
            return redirect()->route('loginUser')->with('success', 'Register Succesfully, You can Login Now!');
        } else {
            return redirect()->route('createUser')->with('failed', 'User not added');

        }

    }
    public function loginUser()
    {
        if (Auth::check()) {
            if (auth()->user()->id_role == 1) {
                return redirect()->route('Dashboard');
            } else if (auth()->user()->id_role == 2) {
                return redirect()->route('writter');
            } else if (auth()->user()->id_role == 3) {
                return redirect()->route('StoryApps');
            }
        }

        return view('Auth.Login');
    }
    public function writter()
    {
        if (Auth::check()) {
            if (auth()->user()->id_role == 1) {
                return redirect()->route('Dashboard');
            } else if (auth()->user()->id_role == 2) {
                return redirect()->route('writter');
            } else if (auth()->user()->id_role == 3) {
                return redirect()->route('StoryApps');
            }
        }

        return view('Auth.Login');
    }

    public function loginAdmin()
    {
        if (Auth::check()) {
            if (auth()->user()->id_role == 1) {
                return redirect()->route('Dashboard');
            } else if (auth()->user()->id_role == 2) {
                return redirect()->route('writter');
            } else if (auth()->user()->id_role == 3) {
                return redirect()->route('StoryApps');
            }
        }

        return view('admin.Auth.Login');
    }


    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],


        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Mendapatkan objek pengguna setelah otentikasi berhasil


            // Periksa apakah ada URL sebelumnya yang tersimpan dalam session
            if (Session::has('previous_url')) {
                $previousUrl = Session::get('previous_url');
                Session::forget('previous_url'); // Hapus URL sebelumnya dari session
                return redirect()->to($previousUrl); // Arahkan pengguna kembali ke URL sebelumnya
            }
            Session::put('previous_url', url()->current());
            // Jika status pengguna aktif,  arahkan pengguna berdasarkan peran pengguna

            if ($user->id_role == 1) {
                return redirect()->route('Dashboard');
            } elseif ($user->id_role == 2) {
                return redirect()->route('writter');
            }

        }

        return back()->with('error', 'Wrong email or password!');
    }

    public function logout(Request $request)
    {
        // Menyimpan URL sebelumnya dalam session sebelum keluar
        Session::put('previous_url', url()->previous());

        // Lakukan proses logout
        Auth::logout();

        return redirect()->route('loginUser');
    }
}

