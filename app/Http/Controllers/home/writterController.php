<?php

namespace App\Http\Controllers\home;

use App\Models\adminModel;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

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
            $data['result'] = adminModel::DataDashboard();
            return view('home.writter.dashboard', $data);
        }
    }
    public function profiles($id = null)
    {
        if (is_null($id)) {
            $id = auth()->id();
        }
        $data['user'] = adminModel::getDataById('users', 'id', $id);
        $data['genre'] = adminModel::getData('genre');
        // dd($data);

        return view("home.writter.profile.profile", compact('data'));
    }

    public function dataStories()
    {

        $data['stories'] = adminModel::StoryGenre2();
        return view("home.writter.dataStories.dataStories", compact('data'));
    }
    public function dataChapters()
    {

        $data = adminModel::StoryChapters();
        return view("home.writter.dataChapters.dataChapters", compact('data'));
    }
    public function dataCharacters()
    {

        $data = adminModel::CharacterStoryChapters();
        return view("home.writter.dataCharacters.dataCharacters", compact('data'));
    }
    public function dataDialogs()
    {

        $data = adminModel::DialogCharactersStoryChapters();
        return view("home.writter.dataDialogs.dataDialogs", compact('data'));
    }
    public function dataFavorites()
    {

        $data['favorit'] = adminModel::getData('favorites');
        $data['favorites'] = adminModel::UserFavoriteStory();
        return view("home.writter.dataFavorites.dataFavorites", compact('data'));
    }

    public function dataRates()
    {

        $data['rates'] = adminModel::StoryUserRate2();
        return view("home.writter.dataRates.dataRates", compact('data'));
    }
    public function notifications()
    {
        $unreadNotifications = adminModel::getUnreadNotificationsWriter()->items(); // Ambil item-data dari Paginator
        $totalUnreadCount = adminModel::countUnreadNotificationsWriter();

        return response()->json([
            'notifications' => $unreadNotifications,
            'total_unread_count' => $totalUnreadCount
        ]);
    }
    public function markNotificationAsReads($id)
    {
        $updatedCount = Notification::markNotificationAsReadsWriter($id);

        return response()->json(['success' => true, 'message' => 'Notification marked as read', 'is_read' => $updatedCount]);
    }



    // ========================================= add data ======================================== //

    // story part ----------------------------------------------------- //
    public function addStoryPage()
    {
        $data = adminModel::getData('genre');
        return view('home.writter.dataStories.addStories', compact('data'));
    }
    public function addStory(Request $request)
    {
        $validation = $request->validate([
            // 'id_category' => 'required',
            'id_genre' => 'required',
            'title' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sinopsis' => 'required',
            'book_status' => 'required',
            'created_at' => 'required',
        ]);

        $uploadsPath = public_path('upload');
        if (!File::isDirectory($uploadsPath)) {
            File::makeDirectory($uploadsPath, 0777, true, true);
        }

        // Simpan gambar ke direktori public/uploads
        $image = $request->file('images');
        $imageName = $image->hashName();
        $image->move($uploadsPath, $imageName);

        $data = array_merge($validation, [
            'images' => $imageName,
            // 'id_category' => 3,
            'id_user' => auth()->user()->id
        ]);

        if (adminModel::CreateData('stories', $data)) {
            // Dapatkan id_story dari cerita yang baru saja disimpan
            $id_story = DB::table('stories')->latest('id_story')->first()->id_story;

            // Buat array data rating
            $rate = [
                'id_user' => auth()->user()->id,
                'id_story' => $id_story,
                'rate' => 1,
                'status' => 0,
                "created_at" => now('Asia/Jakarta')
            ];

            // Simpan data rating awal
            adminModel::CreateData('rates', $rate);
            return redirect()->route('dataStories')->with('success', 'Successfully added new Story!');
        } else {
            return back()->withErrors(['Failed to add new Story']);
        }
    }

    // end story part ----------------------------------------------------- //


    // chapters part ----------------------------------------------------- //
    public function addChaptersPage()
    {
        $data = adminModel::getData('stories');
        return view('home.writter.dataChapters.addChapters', compact('data'));
    }
    public function addChapters(Request $request)
    {
        $validation = $request->validate([
            'chapter' => 'required',
            'id_story' => 'required'
        ]);

        $data = array_merge($validation, [
            "created_at" => now('Asia/Jakarta'),
        ]);
        if (adminModel::CreateData('chapters', $data)) {
            return redirect()->route('dataChapters')->with('success', 'Add Data Chapters Succesfully!');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Chapters');

        }
    }
    // end story part ----------------------------------------------------- //

    // chapters part ----------------------------------------------------- //
    public function addCharactersPage()
    {
        $data['stories'] = adminModel::getData('stories');
        $data['chapters'] = adminModel::getData('chapters');
        return view('home.writter.dataCharacters.addCharacters', compact('data'));
    }
    public function addCharacters(Request $request)
    {
        $validation = $request->validate([
            'id_story' => 'required',
            'id_chapter' => 'required',
            'character' => 'required|array', // Assuming 'characters' is an array in your form
        ]);

        $characters = $request->input('character');
        $data = [];

        foreach ($characters as $character) {
            $data[] = [
                'id_story' => $validation['id_story'],
                'id_chapter' => $validation['id_chapter'],
                'character' => $character,
                'created_at' => now('Asia/Jakarta'),
            ];
        }
        if (adminModel::CreateData('characters', $data)) {
            return redirect()->route('dataCharacters')->with('success', 'Add Data Characters Succesfully!');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Characters');

        }
    }
    // end story part ----------------------------------------------------- //

    // story part ----------------------------------------------------- //
    public function GetCharacters()
    {

        $characters = adminModel::getData2('characters');
        return response()->json($characters);

    }
    public function addDialogsPage()
    {
        $data['chapters'] = adminModel::getData('chapters');
        $data['stories'] = adminModel::getData('stories');
        $data['characters'] = adminModel::getData('characters');
        $data['charactersJson'] = json_encode($data['characters']);
        return view('home.writter.dataDialogs.addDialogs', $data);

    }


    public function addDialogs(Request $request)
    {
        $validation = $request->validate([
            'id_chapter' => 'required',
            'id_story' => 'required',
            'id_character' => 'required|array',
            'dialog' => 'required|array'
        ]);

        $id_chapter = $validation['id_chapter'];
        $id_story = $validation['id_story'];
        $idCharacters = $validation['id_character'];
        $dialogs = $validation['dialog'];
        $data = [];

        foreach ($dialogs as $key => $dialog) {
            $data[] = [
                'id_chapter' => $id_chapter,
                'id_story' => $id_story,
                'id_character' => $idCharacters[$key],
                'dialog' => $dialog,
                'created_at' => now('Asia/Jakarta'),
            ];
        }
        if (adminModel::CreateData('dialogs', $data)) {
            return redirect()->route('dataDialogs')->with('success', 'Add Data Dialogs Succesfully!');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Dialogs');

        }
    }
    // end story part ----------------------------------------------------- //


    // ========================================= edit data ======================================== //

    // story part ----------------------------------------------------- //
    public function updateStatus(Request $request, $id_story)
    {
        $selectedStatus = $request->input('selectedStatus');

        $data = array(
            'book_status' => $selectedStatus,
            'updated_at' => now('Asia/Jakarta')
        );
        // Update status di model atau repository Anda
        adminModel::updateData('stories', 'id_story', $id_story, $data);

        // Beri respons jika perlu
        return response()->json(['message' => 'Status updated successfully']);

    }


    public function editStory($id)
    {
        $data['data'] = adminModel::getDataById('stories', 'id_story', $id);
        $data['ShowGenre'] = adminModel::getDataById('genre', 'id_genre', $id);
        $data['genres'] = adminModel::getData('genre');
        // $data['categories'] = adminModel::getData('categories');
        return view('home.writter.dataStories.editStories', $data);
    }
    public function updateStoryS(Request $request, $id)
    {
        $validation = $request->validate([
            'id_genre' => 'required',
            // 'id_category' => 'required',
            'title' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sinopsis' => 'required',
            'created_at' => 'required',
            'book_status' => 'required',
        ]);
        $updatedata = adminModel::getDataById('stories', 'id_story', $id);

        $updatedata->id_genre = $validation['id_genre'];
        // $updatedata->id_category = 3;
        $updatedata->title = $validation['title'];
        $updatedata->id_user = auth()->user()->id;
        $updatedata->sinopsis = $validation['sinopsis'];
        $updatedata->book_status = $validation['book_status'];
        $updatedata->created_at = $validation['created_at'];
        $updatedata->updated_at = now(); // or Carbon::now('Asia/Jakarta');
        // dd($updatedata);

        // Cek apakah user mengganti gambar atau tidak
        if ($request->hasFile('images')) {
            // Hapus gambar lama jika ada
            if ($updatedata->images) {
                $oldImagePath = public_path($updatedata->images);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Simpan gambar ke direktori public/uploads
            $image = $request->file('images');
            $imageName = $image->hashName();
            $image->move(public_path('upload'), $imageName);

            // Atur path gambar untuk user
            $updatedata->images = $imageName;
        }

        // Memanggil updateData dan mengevaluasi hasilnya
        if (adminModel::updateData('stories', 'id_story', $id, $updatedata)) {
            // Jika berhasil
            return redirect()->route('dataStories')->with('success', 'Product Updated Successfully!');
        } else {
            // Jika gagal, maka akan ditampilkan response gagal
            return response()->json(['messageFailed' => 'Gagal mengubah data']);
        }
    }
    // end story part ----------------------------------------------------- //

    // chpaters part ----------------------------------------------------- //
    public function editChapters($id)
    {
        $data['stories'] = adminModel::getData('stories');
        $data['chapters'] = adminModel::getDataById('chapters', 'id_chapter', $id);

        return view('home.writter.dataChapters.editChapters', $data);
    }
    public function updateChapters(Request $request, $id)
    {
        $validation = $request->validate([
            'chapter' => 'required',
            'id_story' => 'required',
            'created_at' => 'required',

        ]);
        $updateData = adminModel::getDataById('chapters', 'id_chapter', $id);

        // Update the fields based on the validation data
        $updateData->chapter = $validation['chapter'];
        $updateData->id_story = $validation['id_story'];
        $updateData->created_at = $validation['created_at'];
        $updateData->updated_at = now('Asia/Jakarta');
        // dd($updateData);

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('chapters', 'id_chapter', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect()->route('dataChapters');
        } else {
            return back()->withInput();
        }
    }
    // end story part ----------------------------------------------------- //

    // chpaters part ----------------------------------------------------- //
    public function editCharacters($id)
    {
        $data['stories'] = adminModel::getData('stories');
        $data['chapters'] = adminModel::getData('chapters');
        $data['characters'] = adminModel::getDataById('characters', 'id_character', $id);

        return view('home.writter.dataCharacters.editCharacters', $data);
    }
    public function updateCharacters(Request $request, $id)
    {
        $validation = $request->validate([
            'id_story' => 'required',
            'id_chapter' => 'required',
            'character' => 'required|array',
            'created_at' => 'required',
        ]);

        // Mendapatkan data karakter berdasarkan ID
        $character = adminModel::getDataById('characters', 'id_character', $id);

        // Mengupdate field-field yang diperlukan berdasarkan validasi
        $character->id_story = $validation['id_story'];
        $character->id_chapter = $validation['id_chapter'];
        $character->character = $validation['character'];
        $character->created_at = $validation['created_at'];
        $character->updated_at = now('Asia/Jakarta'); // Menggunakan now() untuk mengatur updated_at

        // Menyimpan perubahan pada data karakter
        adminModel::updateData('characters', 'id_character', $id, (array) $character);

        // Menghapus semua karakter terkait dengan cerita ini
        adminModel::deleteData('characters', 'id_character', $id);

        // Menyiapkan data baru untuk dimasukkan sebagai karakter terkait
        $data = [];
        foreach ($validation['character'] as $characterData) {
            $data[] = [
                'id_story' => $validation['id_story'],
                'id_chapter' => $validation['id_chapter'],
                'character' => $characterData,
                'created_at' => $validation['created_at'],
                'updated_at' => now('Asia/Jakarta')
            ];
        }

        // Menyimpan karakter baru menggunakan createMany
        $executeUpdate = adminModel::CreateData('characters', $data);


        if ($executeUpdate == true) {
            return redirect()->route('dataCharacters');
        } else {
            return back()->withInput();
        }
    }
    // end story part ----------------------------------------------------- //

    // dialogs part ----------------------------------------------------- //
    public function editDialogs($id)
    {
        $data['dialogs'] = adminModel::getDataById('dialogs', 'id_dialog', $id);
        $data['characters'] = adminModel::getData('characters');
        $data['stories'] = adminModel::getData('stories');
        $data['chapters'] = adminModel::getData('chapters');
        return view('home.writter.dataDialogs.editDialogs', $data);
    }
    public function updateDialogs(Request $request, $id)
    {
        $validation = $request->validate([
            'id_chapter' => 'required',
            'id_story' => 'required',
            'id_character' => 'required',
            'dialog' => 'required',
            'created_at' => 'required'
        ]);

        $updateData = adminModel::getDataById('dialogs', 'id_dialog', $id);

        // Update the fields based on the validation data
        $updateData->id_chapter = $validation['id_chapter'];
        $updateData->id_story = $validation['id_story'];
        $updateData->id_character = $validation['id_character'];
        $updateData->dialog = $validation['dialog'];
        $updateData->created_at = $validation['created_at']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('dialogs', 'id_dialog', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect()->route('dataDialogs');
        } else {
            return back()->withInput();
        }
    }
    // end story part ----------------------------------------------------- //

    // ========================================= delete data ======================================== //

    // story part ----------------------------------------------------- //
    public function deleteStories($id)
    {
        try {
            // Menghapus data dari database
            adminModel::deleteData('stories', 'id_story', $id);

            // Jika penghapusan berhasil, kembalikan respons JSON dengan status 200 (OK)
            return response()->json(['message' => 'Data Story Kamu Berhasil Dihapus'], 200);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan respons JSON dengan status 500 (Internal Server Error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // end story part ----------------------------------------------------- //


    // chapterz part ----------------------------------------------------- //
    public function deleteChapters($id)
    {
        try {
            // Menghapus data dari database
            adminModel::deleteData('chapters', 'id_chapter', $id);

            // Jika penghapusan berhasil, kembalikan respons JSON dengan status 200 (OK)
            return response()->json(['message' => 'Data Chapter Kamu Berhasil Dihapus'], 200);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan respons JSON dengan status 500 (Internal Server Error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // end story part ----------------------------------------------------- //


    // characters part ----------------------------------------------------- //
    public function deleteCharacters($id)
    {
        try {
            // Menghapus data dari database
            adminModel::deleteData('characters', 'id_character', $id);

            // Jika penghapusan berhasil, kembalikan respons JSON dengan status 200 (OK)
            return response()->json(['message' => 'Data character Kamu Berhasil Dihapus'], 200);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan respons JSON dengan status 500 (Internal Server Error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // end story part ----------------------------------------------------- //

    // dialogs part ----------------------------------------------------- //
    public function deleteDialogs($id)
    {
        try {
            // Menghapus data dari database
            adminModel::deleteData('dialogs', 'id_dialog', $id);

            // Jika penghapusan berhasil, kembalikan respons JSON dengan status 200 (OK)
            return response()->json(['message' => 'Data dialog Kamu Berhasil Dihapus'], 200);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan respons JSON dengan status 500 (Internal Server Error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // end story part ----------------------------------------------------- //

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
