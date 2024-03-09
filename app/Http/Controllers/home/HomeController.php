<?php

namespace app\Http\Controllers\home;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\adminModel;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // user data

        $data['user'] = Auth::User();
        $data['story'] = adminModel::getData('stories');

        $id = Auth::id(); // Mendapatkan ID pengguna yang sedang masuk
        $data['favorit'] = DB::table('favorites')
            ->where('id_user', $id)
            ->pluck('id_story')
            ->toArray();
        // dd($data['favorit']);
        $data['NewStoryRate'] = adminModel::NewStoryRate();
        $data['RateStoryPopuler'] = adminModel::RateStoryPopuler();
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang masuk

        $data['RateRecomendationStory'] = adminModel::RateRecomendationStory($userId);
        $data['genre'] = adminModel::getData('genre');

        // dd($data['counts']);

        return view('home.StoryApps', compact('data'));
    }

    public function profile($id)
    {
        $data['user'] = adminModel::getDataById('users', 'id', $id);
        $data['genre'] = adminModel::getData('genre');

        // dd($data['counts']);
        // Count the number of stories for the user
        // $data['story'] = adminModel::CountData('stories', 'id_story', $id);
        return view("home.profile", compact('data'));
    }
    public function UpdateUser(Request $request, $id)
    {
        $validation = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'phone_number' => 'required|numeric',
            'image_user' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048' // Hapus required agar tidak wajib diisi
        ]);

        $uploadsPath = public_path('upload');
        if (!File::isDirectory($uploadsPath)) {
            File::makeDirectory($uploadsPath, 0777, true, true);
        }
        $updatedata = adminModel::getDataById('users', 'id', $id);

        $updatedata->full_name = $validation['full_name'];
        // $updatedata->id_category = 3;
        $updatedata->email = $validation['email'];
        $updatedata->username = $validation['username'];
        $updatedata->phone_number = $validation['phone_number'];
        $updatedata->updated_at = now(); // or Carbon::now('Asia/Jakarta');

        // Cek apakah user mengganti gambar atau tidak
        if ($request->hasFile('image_user')) {
            // Hapus gambar lama jika ada
            if ($updatedata->image_user) {
                $oldImagePath = public_path($updatedata->image_user);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Simpan gambar ke direktori public/uploads
            $image = $request->file('image_user');
            $imageName = $image->hashName();
            $image->move(public_path('upload'), $imageName);

            // Atur path gambar untuk user
            $updatedata->image_user = $imageName;
        }
        $executeUpdate = adminModel::updateData('users', 'id', $id, $updatedata);

        if ($executeUpdate) {
            return redirect()->route('profile', ['id' => $id])->with('success', 'Data User Successfully Updated.');
        } else {
            return back()->withInput()->with('error', 'Failed to update user data.');
        }
    }
    public function UpdatePassword(Request $request, $id)
    {
        $validation = $request->validate([
            'password' => 'required'
        ]);


        $updateDataUser = adminModel::getDataById('users', 'id', $id);
        $updateDataUser->password = bcrypt($validation['password']);

        $executeUpdate = adminModel::updateData('users', 'id', $id, $updateDataUser);

        if ($executeUpdate) {
            return redirect()->route('profile', ['id' => $id])->with('success-password', 'Password-Update');
        } else {
            return back()->withInput();

        }
    }
    public function favorite(Request $request)
    {
        // dd($request->all());
        $idStory = $request->input('id_story');
        $id = auth()->user()->id;
        // dd($id);
        if (!empty($request->input('favorit'))) {
            $status = $request->input('favorit');
        } else {
            $status = 0;
        }


        // Check if the user has already favorited the story
        $favorite = DB::table('favorites')->where('id_story', $idStory)
            ->where('id_user', $id)
            ->first();

        // If the user has favorited the story and wants to remove it
        if ($favorite && $status == 0) {
            DB::table('favorites')->where('id_favorite', $favorite->id_favorite)->delete();
        } elseif (!$favorite && $status == 1) {
            // If the user hasn't favorited the story and wants to add it
            $data = [
                'id_story' => $idStory,
                'favorit' => $status,
                'id_user' => $id,
                'created_at' => now()->setTimezone('Asia/Jakarta'),
            ];
            adminModel::CreateData('favorites', $data);
            $notif = [
                'id_user' => $data['id_user'], // Sesuaikan dengan ID pengguna yang sesuai
                "message" => 'Cerita anda ada yang menjadi favorite  oleh user lainnya',
                "type" => 'favorite',
                "entity_id" => $data['id_story'],
                "sender_id" => auth()->user()->id,
                "created_at" => Carbon::now('Asia/Jakarta')
            ];
            Notification::insertNotification($notif);
        }

        return response()->json(['success' => true, 'message' => 'Status favorit diperbarui.']);
    }


    // chatstory ============================================================

    public function StoryByGenre($id)
    {
        $data['genre'] = adminModel::getData('genre');
        $data['favorit'] = adminModel::getData('favorites');
        $data['stories'] = adminModel::StoryListByGenre($id);
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang masuk
        $data['RateRecomendationStory'] = adminModel::RateRecomendationStory($userId);
        return view('home.StoryByGenre.StoryByGenre', compact('data'));
    }


    public function StoryList()
    {
        // $data['user'] = adminModel::getDataById('users', 'id', $id);
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang masuk
        $data['RateRecomendationStory'] = adminModel::RateRecomendationStory($userId);
        $data['genre'] = adminModel::getData('genre');
        $data['stories'] = adminModel::CountDataRate();
        $data['favorit'] = adminModel::getData('favorites');

        return view('home.StoryList.StoryList', compact('data'));
    }
    public function detailStory($id)
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang masuk

        $data['favorit'] = DB::table('favorites')
            ->where('id_user', $userId)
            ->pluck('id_story')
            ->toArray();
        $data['RateRecomendationStory'] = adminModel::RateRecomendationStory($userId);
        $data['genre'] = adminModel::getData('genre');
        $data['stories'] = adminModel::getStoryDetail($id);
        $data['favorit'] = adminModel::getData('favorites');
        $data['storyPublish'] = adminModel::getDataById('stories', 'id_story', $id);
        $chapters = adminModel::getDataById2('chapters', 'id_story', $id);
        // dd($chapters);


        return view('home.detail.DetailStory', compact('data', 'chapters'));
    }
    public function ChatStory($id)
    {
        $perPage = 10;
        $data['genre'] = adminModel::getData('genre');
        $data['sinopsis'] = adminModel::GetSinopsis($id, $perPage);

        // dd($data['sinopsis']);
        $data['chapters'] = adminModel::getData('chapters');
        $chapter = adminModel::getDataById('chapters', 'id_chapter', $id);
        $data['datah'] = $data['sinopsis'];

        if (!$data['sinopsis']) {
            abort(404);
        }
        return view('home.chatstory.ChatStory', compact('data', 'chapter', 'perPage'));
    }

    public function loadMore(Request $request, $idChapter)
    {
        $page = $request->input('page', 1);
        $dialogs = adminModel::GetSinopsis($idChapter, 10);
        return response()->json($dialogs->items(), 200);
    }

    // public function send(Request $request)
    // {

    //     $comment = [
    //         'id_user' => $request->input('id_user'),
    //         'id_story' => $request->input('id_story'),
    //         'rate' => $request->input('rate'),
    //         'status' => $request->input('status'),

    //     ];
    //     $execute = adminModel::CreateData('rates', $comment);
    //     if ($execute == true) {
    //         // session()->flash('notification', 'New comment received!');
    //         return redirect('/')->with('success', "Comment Successfully");
    //     } else {
    //         return back()->withInput()->withErrors(['error', 'Please fill in all fields']);
    //     }

    // }


    // public function sendRate(Request $request)
    // {
    //     $users = Auth::user()->id;
    //     $validation = $request->validate([
    //         'id_story' => 'required|numeric',
    //         'rate' => 'required|numeric',
    //     ]);


    //     $data = array_merge($validation, [
    //         'created_at' => now(),
    //         'id' => $users,
    //         'status' => 0
    //     ]);
    //     if (adminModel::CreateData('rates', $data)) {
    //         return response()->json(['success' => true, 'message' => 'Berhasil Memberikan Rating']);
    //         // return redirect()->route('DataRate')->with('success', 'Successfully added new Rate!');
    //     } else {
    //         return response()->json(['error' => 'Gagal Memberikan Rating']);
    //         // return back()->withErrors(['failed to add new Rate']);
    //     }

    // }
    /**
     * Show the form for creating a new resource.
     */
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
