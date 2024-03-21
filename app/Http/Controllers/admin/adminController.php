<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\Story;
use App\Models\Users;
use App\Models\adminModel;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class adminController extends Controller
{
    use HasFactory;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['rate'] = adminModel::getData('rates');
        $data['result'] = adminModel::DataDashboard();
        $data['counts'] = adminModel::CountDataRate();

        return view('admin.Dashboard', $data);
    }


    public function notification()
    {
        $unreadNotifications = adminModel::getUnreadNotifications();
        $totalUnreadCount = adminModel::countUnreadNotifications();

        return response()->json([
            'notifications' => $unreadNotifications,
            'total_unread_count' => $totalUnreadCount
        ]);
    }


    public function ShowALLNotification()
    {
        $data['showNotif'] = adminModel::getData('rates');
        return view('/admin/ShowAllNotification/ShowAllNotification', $data);
    }

    public function markNotificationAsRead($id)
    {
        $updatedCount = Notification::markNotificationAsReads($id);

        return response()->json(['success' => true, 'message' => 'Notification marked as read', 'is_read' => $updatedCount]);
    }

    public function DataUser()
    {
        $data['users'] = adminModel::GetDataPagenation2();
        return view('admin.user.DataUser', $data);
    }

    public function DataCompany()
    {
        // $data['company'] = adminModel::getData3('company', 'id_company');
        $data['company'] = adminModel::GetDataPagenation('company', 'id_company');

        return view('admin.company.DataCompany', $data);
    }
    public function DataContact()
    {
        $data['contact'] = adminModel::GetDataPagenation('contact', 'id_contact');
        return view('admin.contact.DataContact', $data);
    }
    public function DataFaqs()
    {
        $data['faqs'] = adminModel::GetDataPagenation('faqs', 'id_faq');
        return view('admin.faqs.DataFaqs', $data);
    }
    public function DataRate()
    {

        $data['rates'] = adminModel::StoryUserRate();
        return view('admin.story.rate.DataRate', $data);

    }
    public function DataFavorite()
    {
        $data['favorit'] = adminModel::getData('favorites');
        $data['favorites'] = adminModel::UserFavoriteStory();
        return view('admin.story.favorite.DataFavorite', $data);

    }
    public function DataComment()
    {

        $data['comments'] = adminModel::UserCommentsStory();
        return view('admin.story.comment.DataComment', $data);

    }
    public function DataStory()
    {
        $data['stories'] = adminModel::StoryGenre();
        return view('admin.story.story.DataStory', $data);
    }
    public function DataGenre()
    {
        $data['genres'] = adminModel::GetDataPagenation('genre', 'id_genre');
        return view('admin.story.genre.DataGenre', $data);
    }
    public function DataCategories()
    {
        $data['categories'] = adminModel::GetDataPagenation('categories', 'id_category');
        return view('admin.categories.DataCategories', $data);
    }
    public function DataChapters()
    {
        $data = adminModel::StoryChapters();
        return view('admin.story.chapters.DataChapters', compact('data'));
    }
    public function DataCharacters()
    {
        $data = adminModel::CharacterStoryChapters();
        return view('admin.story.characters.DataCharacters', compact('data'));
    }
    public function DataDialog()
    {
        $data['dialogs'] = adminModel::DialogCharactersStoryChapters();
        return view('admin.story.dialog.DataDialog', $data);
    }

    // user CRUD ===========================================================================================================
    // company CRUD ===========================================================================================================
    public function createCompany()
    {
        // $data['characters'] = adminModel::getData('characters');
        // $data['charactersJson'] = json_encode($data['characters']);
        return view('admin.company.AddCompany');

    }


    public function PostCompany(Request $request)
    {

        $validation = $request->validate([
            'company_name' => 'required',
            'about_us' => 'required',
            'term' => 'required',
            'privacy' => 'required'
        ]);

        $data = array_merge($validation, [
            'created_at' => now(),
        ]);

        if (adminModel::CreateData('company', $data)) {

            return redirect('/admin/company/DataCompany')->with('success', 'Data Company Succesfully Added');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Dialogs');
        }
    }
    public function editCompany($id)
    {
        $data['company'] = adminModel::getDataById('company', 'id_company', $id);
        return view('/admin/company/EditCompany', $data);
    }
    public function updateCompany(Request $request, $id)
    {
        $validation = $request->validate([
            'company_name' => 'required',
            'about_us' => 'required',
            'term' => 'required',
            'privacy' => 'required'
        ]);

        $updateData = adminModel::getDataById('company', 'id_company', $id);

        $updateData->about_us = $validation['about_us'];
        $updateData->term = $validation['term']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->privacy = $validation['privacy']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('company', 'id_company', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect('/admin/company/DataCompany')->with('success', 'Data Company Successfully Updated.');
        } else {
            return back()->withInput();

        }
    }
    public function deleteCompany($id)
    {
        $deleteRow = adminModel::deleteData(
            'company',
            'id_company',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Company');

            setTimeout(function () {
                window.location.href = '/admin/company/DataCompany';
            }, 1000);
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Company');
                window.location.href='/admin/company/DataCompanys';
                </script>
                ";
        }
    }

    public function deleteAllCompanies()
    {
        try {
            // Menghapus semua data dari tabel 'company'
            adminModel::deleteAllData('company');

            echo "
            <script>
            alert('Success Delete All Data Companies');
            setTimeout(function () {
                window.location.href = '/admin/company/DataCompany';
            }, 1000);
            </script>
        ";
        } catch (\Exception $e) {
            echo "
            <script>
            alert('Failed to Delete All Data Companies');
            window.location.href='/admin/company/DataCompany';
            </script>
        ";
        }
    }
    // Contact CRUD ===========================================================================================================
    public function createContact()
    {
        // $data['characters'] = adminModel::getData('characters');
        // $data['charactersJson'] = json_encode($data['characters']);
        return view('admin.contact.AddContact');

    }


    public function PostContact(Request $request)
    {

        $validation = $request->validate([
            'email_company' => 'required|email',
            'phone_company' => 'required',
            'sosial_media' => 'required|url',
        ]);

        $data = array_merge($validation, [
            'created_at' => now(),
        ]);

        if (adminModel::CreateData('contact', $data)) {
            return redirect('/admin/contact/DataContact')->with('success', 'Data Contact Succesfully Added.');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Contact');
        }
    }
    public function editContact($id)
    {
        $data['contact'] = adminModel::getDataById('contact', 'id_contact', $id);
        return view('/admin/contact/EditContact', $data);
    }
    public function updateContact(Request $request, $id)
    {

        $validation = $request->validate([
            'email_company' => 'required',
            'phone_company' => 'required',
            'sosial_media' => 'required',
        ]);

        $updateData = adminModel::getDataById('contact', 'id_contact', $id);

        $updateData->email_company = $validation['email_company'];
        $updateData->phone_company = $validation['phone_company']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->sosial_media = $validation['sosial_media']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('contact', 'id_contact', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect('/admin/contact/DataContact')->with('success', 'Data Contact Successfully Updated.');
        } else {
            return back()->withInput();

        }
    }
    public function deleteContact($id)
    {
        $deleteRow = adminModel::deleteData(
            'contact',
            'id_contact',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Contact');

            setTimeout(function () {
                window.location.href = '/admin/contact/DataContact';
            }, 1000);
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Success Delete Data Contact');

                setTimeout(function () {
                    window.location.href = '/admin/contact/DataContact';
                }, 1000);
                </script>
                ";
        }
    }
    // Faqs CRUD ===========================================================================================================
    public function createFaqs()
    {
        // $data['characters'] = adminModel::getData('characters');
        // $data['charactersJson'] = json_encode($data['characters']);
        return view('admin.faqs.AddFaqs');

    }


    public function PostFaqs(Request $request)
    {

        $validation = $request->validate([
            'faq' => 'required',
        ]);

        $data = array_merge($validation, [
            'created_at' => now(),
        ]);

        if (adminModel::CreateData('faqs', $data)) {
            return redirect('/admin/faqs/DataFaqs')->with('success', 'Data Faqs Succesfully Added.');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Faqs');
        }
    }
    public function editFaqs($id)
    {
        $data['faqs'] = adminModel::getDataById('faqs', 'id_faq', $id);
        return view('/admin/faqs/EditFaqs', $data);
    }
    public function updateFaqs(Request $request, $id)
    {

        $validation = $request->validate([
            'faq' => 'required',
        ]);

        $updateData = adminModel::getDataById('faqs', 'id_faq', $id);

        $updateData->faq = $validation['faq']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('faqs', 'id_faq', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect('/admin/faqs/DataFaqs')->with('success', 'Data Faqs Successfully Updated.');
        } else {
            return back()->withInput();

        }
    }
    public function deleteFaqs($id)
    {
        $deleteRow = adminModel::deleteData(
            'faqs',
            'id_faq',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Faqs');

            setTimeout(function () {
                window.location.href = '/admin/faqs/DataFaqs';
            }, 1000);
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Success Delete Data Faqs');

                setTimeout(function () {
                    window.location.href = '/admin/faqs/DataFaqs';
                }, 1000);
                </script>
                ";
        }
    }
    // Genre CRUD ===========================================================================================================
    public function createGenre()
    {
        return view('admin.story.genre.AddGenre');
    }

    public function PostGenre(Request $request)
    {
        $validation = $request->validate([
            'genre' => 'required'
        ]);

        $data = array_merge($validation, [
            "created_at" => now('Asia/Jakarta'),
        ]);
        if (adminModel::CreateData('genre', $data)) {
            return redirect('/admin/story/genre/DataGenre')->with('success', 'Add Data Genre Succesfully!');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Genre');

        }
    }
    public function editGenre($id)
    {
        $data['genres'] = adminModel::getDataById('genre', 'id_genre', $id);
        return view('/admin/story/genre/EditGenre', $data);
    }
    public function updateGenre(Request $request, $id)
    {
        $validation = $request->validate([
            'genre' => 'required',
            'created_at' => 'required' // Assuming 'created_at' is a valid field in your genre table
        ]);

        $updateData = adminModel::getDataById('genre', 'id_genre', $id);

        // Update the fields based on the validation data
        $updateData->genre = $validation['genre'];
        $updateData->created_at = $validation['created_at']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('genre', 'id_genre', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect('/admin/story/genre/DataGenre');
        } else {
            return back()->withInput();
        }
    }

    public function deleteGenre($id)
    {
        $deleteRow = adminModel::deleteData(
            'genre',
            'id_genre',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Genre');
            window.location.href='/admin/story/genre/DataGenre';
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Genre');
                window.location.href='/admin/story/genre/DataGenre';
                </script>
                ";
        }


    }


    // Categories CRUD ===========================================================================================================
    public function createCategories()
    {
        return view('admin.Categories.AddCategories');
    }

    public function PostCategories(Request $request)
    {
        $validation = $request->validate([
            'category' => 'required'
        ]);

        $data = array_merge($validation, [
            "created_at" => now('Asia/Jakarta'),
        ]);
        if (adminModel::CreateData('categories', $data)) {
            return redirect('/admin/Categories/DataCategories')->with('success', 'Add Data Category Succesfully!');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Category');

        }
    }
    public function editCategories($id)
    {
        $data['categories'] = adminModel::getDataById('categories', 'id_category', $id);
        return view('/admin/Categories/EditCategories', $data);
    }
    public function updateCategories(Request $request, $id)
    {
        $validation = $request->validate([
            'category' => 'required',
            'created_at' => 'required' // Assuming 'created_at' is a valid field in your genre table
        ]);

        $updateData = adminModel::getDataById('categories', 'id_category', $id);

        // Update the fields based on the validation data
        $updateData->category = $validation['category'];
        $updateData->created_at = $validation['created_at']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('categories', 'id_category', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect('/admin/Categories/DataCategories');
        } else {
            return back()->withInput();
        }
    }

    public function deleteCategories($id)
    {
        $deleteRow = adminModel::deleteData(
            'categories',
            'id_category',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Categories');
            window.location.href='/admin/Categories/DataCategories';
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Categories');
                window.location.href='/admin/Categories/DataCategories';
                </script>
                ";
        }


    }
    // end Categories CRUD ===========================================================================================================

    // Chapters CRUD ===========================================================================================================
    public function createChapters()
    {
        $data = adminModel::getData('stories');
        return view('admin.story.chapters.AddChapters', compact('data'));
    }

    public function PostChapter(Request $request)
    {
        $validation = $request->validate([
            'chapter' => 'required',
            'id_story' => 'required'
        ]);

        $data = array_merge($validation, [
            "created_at" => now('Asia/Jakarta'),
        ]);
        if (adminModel::CreateData('chapters', $data)) {
            return redirect('/admin/story/chapters/DataChapters')->with('success', 'Add Data Chapters Succesfully!');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Chapters');

        }
    }
    public function editChapter($id)
    {
        $data['stories'] = adminModel::getData('stories');
        $data['chapters'] = adminModel::getDataById('chapters', 'id_chapter', $id);
        return view('/admin/story/chapters/EditChapters', $data);
    }
    public function updateChapter(Request $request, $id)
    {
        $validation = $request->validate([
            'chapter' => 'required',
            'id_story' => 'required',
            'created_at' => 'required'
        ]);

        $updateData = adminModel::getDataById('chapters', 'id_chapter', $id);

        // Update the fields based on the validation data
        $updateData->chapter = $validation['chapter'];
        $updateData->id_story = $validation['id_story'];
        $updateData->created_at = $validation['created_at']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('chapters', 'id_chapter', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect('/admin/story/chapters/DataChapters');
        } else {
            return back()->withInput();
        }
    }
    public function deleteChapter($id)
    {
        $deleteRow = adminModel::deleteData(
            'chapters',
            'id_chapter',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Chapters');
            window.location.href='/admin/story/chpaters/DataChapters';
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Chapters');
                window.location.href='/admin/story/chapters/DataChapters';
                </script>
                ";
        }
    }

    // Characters CRUD ===========================================================================================================
    public function createCharacters()
    {
        $data['characters'] = adminModel::getData('characters');
        $data['chapters'] = adminModel::getData('chapters');
        $data['stories'] = adminModel::getData('stories');
        return view('admin.story.characters.AddCharacters', $data);
    }

    public function PostCharacter(Request $request)
    {

        // $validation = $request->validate([
        //     'id_story' => 'required',
        //     'character' => 'required'
        // ]);

        // $data = array_merge($validation, [
        //     "created_at" => now('Asia/Jakarta'),
        // ]);
        // if (adminModel::CreateData('characters', $data)) {
        //     return redirect('/admin/story/characters/DataCharacters')->with('success', 'Add Data Characters Succesfully!');
        // } else {
        //     return back()->withInput()->with('error', 'Failed Add Data Characters');

        // }

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
            return redirect('/admin/story/characters/DataCharacters')->with('success', 'Add Data Characters Successfully!');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Characters');
        }
    }
    public function editCharacter($id)
    {
        $data['characters'] = adminModel::getDataById('characters', 'id_character', $id);
        $data['stories'] = adminModel::getData('stories');
        $data['chapters'] = adminModel::getData('chapters');
        return view('/admin/story/characters/EditCharacters', $data);
    }
    public function updateCharacter(Request $request, $id)
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
        adminModel::CreateData('characters', $data);

        // Redirect ke halaman yang sesuai
        return redirect('/admin/story/characters/DataCharacters');



    }
    public function deleteCharacter($id)
    {
        $deleteRow = adminModel::deleteData(
            'characters',
            'id_character',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Characters');
            window.location.href='/admin/story/characters/DataCharacters';
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Characters');
                window.location.href='/admin/story/characters/DataCharacters';
                </script>
                ";
        }
    }

    // Dialog CRUD ===========================================================================================================
    public function GetDialog()
    {

        $characters = adminModel::getData2('characters');
        return response()->json($characters);

    }
    public function createDialog()
    {
        $data['chapters'] = adminModel::getData('chapters');
        $data['stories'] = adminModel::getData('stories');
        $data['characters'] = adminModel::getData('characters');
        $data['charactersJson'] = json_encode($data['characters']);
        return view('admin.story.dialog.AddDialog', $data);

    }


    public function PostDialog(Request $request)
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
            return redirect('/admin/story/dialog/DataDialog')->with('success', 'Add Data Dialogs Succesfully!');
        } else {
            return back()->withInput()->with('error', 'Failed Add Data Dialogs');
        }
    }
    public function editDialog($id)
    {
        $data['dialogs'] = adminModel::getDataById('dialogs', 'id_dialog', $id);
        $data['characters'] = adminModel::getData('characters');
        $data['stories'] = adminModel::getData('stories');
        $data['chapters'] = adminModel::getData('chapters');
        return view('/admin/story/dialog/EditDialog', $data);
    }
    public function updateDialog(Request $request, $id)
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
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('dialogs', 'id_dialog', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect('/admin/story/dialog/DataDialog');
        } else {
            return back()->withInput();

        }
    }
    public function deleteDialog($id)
    {
        $deleteRow = adminModel::deleteData(
            'dialogs',
            'id_dialog',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Dialogs');
            window.location.href='/admin/story/dialog/DataDialog';
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Dialogs');
                window.location.href='/admin/story/dialog/DataDialogs';
                </script>
                ";
        }
    }

    // Rate CRUD ===========================================================================================================
    public function createRate()
    {
        $data['stories'] = adminModel::getData('stories');
        $data['users'] = adminModel::getData('users');
        return view('admin.story.rate.AddRate', $data);

    }
    public function PostRate(Request $request)
    {
        $validation = $request->validate([
            'id_story' => 'required',
            'id_user' => 'required',
            'rate' => 'required',
        ]);


        $data = array_merge($validation, [
            'status' => 0,
            'created_at' => Carbon::now('Asia/Jakarta')
        ]);

        if (adminModel::CreateData('rates', $data)) {
            $notif = [
                'id_user' => $data['id_user'], // Sesuaikan dengan ID pengguna yang sesuai
                "message" => 'Anda memiliki penilaian baru pada cerita ini',
                "type" => 'rate',
                "entity_id" => $data['id_story'],
                "sender_id" => auth()->user()->id,
                "tgl_dibuat" => Carbon::now('Asia/Jakarta')
            ];
            Notification::insertNotification($notif);
            return redirect()->route('DataRate')->with('success', 'Successfully added new Rate!');
        } else {
            return back()->withErrors(['failed to add new Rate']);
        }

    }
    public function rateStory(Request $request, $id)
    {
        $rate = $request->input('rate');
        adminModel::updateRate($id, $rate);
        return response()->json(['success' => true, 'message' => 'Successfully rated the story']);

    }

    public function editRate($id)
    {
        $data['rate'] = adminModel::getDataById('rates', 'id_rate', $id);
        $data['stories'] = adminModel::getData('stories');
        $data['users'] = adminModel::getData('users');
        return view('admin/story/rate/EditRate', $data);
    }
    public function updateRate(Request $request, $id)
    {
        $validation = $request->validate([
            'rate' => 'required',
            'id_story' => 'required',
            'id_user' => 'required',
            'created_at' => 'required',
        ]);


        $updateData = adminModel::getDataById('rates', 'id_rate', $id);
        $updateData->rate = $validation['rate'];
        $updateData->id_story = $validation['id_story'];
        $updateData->id_user = $validation['id_user'];
        $updateData->created_at = $validation['created_at'];
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        $executeUpdate = adminModel::updateData('rates', 'id_rate', $id, $updateData);

        if ($executeUpdate == true) {
            return redirect('/admin/story/rate/DataRate');
        } else {
            return back()->withInput();

        }

    }
    public function deleteRate($id)
    {
        $deleteRow = adminModel::deleteData(
            'rates',
            'id_rate',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Rate');
            window.location.href='/admin/story/rate/DataRate';
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Rate');
                window.location.href='/admin/story/rate/DataRate';
                </script>
                ";
        }
    }

    //  comment CRUD =========================================================================================================
    public function createComment()
    {
        $data['stories'] = adminModel::getData('stories');
        $data['users'] = adminModel::getData('users');
        return view('admin.story.comment.AddComment', compact('data'));
    }

    public function PostComment(Request $request)
    {

        $validation = $request->validate([
            'id_story' => 'required',
            'id_user' => 'required',
            'comment' => 'required'
        ]);

        // Validasi berhasil, lanjutkan proses
        $data = array_merge($validation, [
            "created_at" => now('Asia/Jakarta'),

        ]);

        // Menyimpan komentar
        if (adminModel::CreateData('comments', $data)) {
            // Menambahkan notifikasi
            $notif = [
                'id_user' => $data['id_user'], // Sesuaikan dengan ID pengguna yang sesuai
                "message" => 'Anda memiliki komentar baru pada cerita ini',
                "type" => 'comment',
                "entity_id" => $data['id_story'],
                "sender_id" => auth()->user()->id,
                "tgl_dibuat" => Carbon::now('Asia/Jakarta')
            ];
            Notification::insertNotification($notif);

            // Redirect dengan pesan sukses
            return redirect('/admin/story/comment/DataComment')->with('success', 'Add Data Comment Successfully!');
        } else {
            // Jika gagal menyimpan, kembali ke halaman sebelumnya dengan pesan error
            return back()->withInput()->with('error', 'Failed to Add Data Comment');
        }
    }
    public function editComment($id)
    {
        $data['comments'] = adminModel::getDataById('comments', 'id_comment', $id);
        $data['users'] = adminModel::getData('users');
        $data['stories'] = adminModel::getData('stories');
        return view('/admin/story/comment/EditComment', $data);
    }

    public function updateComment(Request $request, $id)
    {
        $validation = $request->validate([
            'id_story' => 'required',
            'id_user' => 'required',
            'comment' => 'required',
            'created_at' => 'required' // Assuming 'created_at' is a valid field in your genre table
        ]);

        $updateData = adminModel::getDataById('comments', 'id_comment', $id);

        // Update the fields based on the validation data
        $updateData->id_story = $validation['id_story'];
        $updateData->id_user = $validation['id_user'];
        $updateData->comment = $validation['comment'];
        $updateData->created_at = $validation['created_at']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('comments', 'id_comment', $id, $updateData);

        if ($executeUpdate == true) {
            // Buat dan simpan notifikasi
            $notif = [
                'id_user' => $validation['id_user'], // Sesuaikan dengan ID pengguna yang sesuai
                'message' => 'Anda memiliki komentar baru pada cerita ini',
                'type' => 'comment',
                "entity_id" => $validation['id_story'],
                'sender_id' => auth()->user()->id, // ID pengirim notifikasi (pengguna yang sedang login)
                'tgl_dibuat' => Carbon::now('Asia/Jakarta')
            ];
            Notification::insertNotification($notif);

            return redirect('/admin/story/comment/DataComment');
        } else {
            return back()->withInput();
        }
    }

    public function deleteComment($id)
    {
        $deleteRow = adminModel::deleteData(
            'comments',
            'id_comment',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Comment');
            window.location.href='/admin/story/comment/DataComment';
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Comment');
                window.location.href='/admin/story/comment/DataComment';
                </script>
                ";
        }


    }

    // end comment CRUD =========================================================================================================

    // Favorite CRUD =========================================================================================================
    //  comment CRUD =========================================================================================================
    public function createFavorite()
    {
        $data['stories'] = adminModel::getData('stories');
        $data['favorites'] = adminModel::UserFavoriteStory2();
        $data['users'] = adminModel::getData('users');
        return view('admin.story.favorite.AddFavorite', compact('data'));
    }

    public function PostFavorite(Request $request)
    {

        $validation = $request->validate([
            'id_story' => 'required',
            'id_user' => 'required',
            // 'favorit' => 'required'
        ]);

        // Validasi berhasil, lanjutkan proses
        $data = array_merge($validation, [
            "created_at" => now('Asia/Jakarta'),
            "favorit" => 1,

        ]);
        // dd($data);
        // Menyimpan komentar
        if (adminModel::CreateData('favorites', $data)) {
            // Menambahkan notifikasi
            $notif = [
                'id_user' => $data['id_user'], // Sesuaikan dengan ID pengguna yang sesuai
                "message" => 'Cerita anda ada yang menjadi favorite  oleh user lainnya',
                "type" => 'favorite',
                "entity_id" => $data['id_story'],
                "sender_id" => auth()->user()->id,
                "tgl_dibuat" => Carbon::now('Asia/Jakarta')
            ];
            Notification::insertNotification($notif);

            // Mengembalikan respons JSON jika berhasil
            return response()->json(['success' => true, 'message' => 'Berhasil menambahkan ke favorite!']);
        } else {
            // Mengembalikan respons JSON jika gagal
            return response()->json(['failed' => true, 'message' => 'Gagal menambahkan ke favorite!']);
        }
    }
    public function editFavorite($id)
    {
        $data['favorites'] = adminModel::getDataById('favorites', 'id_favorite', $id);
        $data['users'] = adminModel::getData('users');
        $data['stories'] = adminModel::getData('stories');
        return view('/admin/story/favorite/EditFavorite', $data);
    }

    public function updateFavorite(Request $request, $id)
    {
        $validation = $request->validate([
            'id_story' => 'required',
            'id_user' => 'required',
            'favorit' => 'required',
            'created_at' => 'required' // Assuming 'created_at' is a valid field in your genre table
        ]);

        $updateData = adminModel::getDataById('favorites', 'id_favorite', $id);

        // Update the fields based on the validation data
        $updateData->id_story = $validation['id_story'];
        $updateData->id_user = $validation['id_user'];
        $updateData->favorit = $validation['favorit'];
        $updateData->created_at = $validation['created_at']; // Assuming 'created_at' is a valid field in your genre table
        $updateData->updated_at = Carbon::now('Asia/Jakarta');

        // Call the updateData method with the correct field names
        $executeUpdate = adminModel::updateData('favorites', 'id_favorite', $id, $updateData);

        if ($executeUpdate == true) {
            // Buat dan simpan notifikasi
            $notif = [
                'id_user' => $validation['id_user'], // Sesuaikan dengan ID pengguna yang sesuai
                'message' => 'Anda memiliki komentar baru pada cerita ini',
                'type' => 'favorite',
                'sender_id' => auth()->user()->id, // ID pengirim notifikasi (pengguna yang sedang login)
                "entity_id" => $validation['id_story'],
                'tgl_dibuat' => Carbon::now('Asia/Jakarta')
            ];
            Notification::insertNotification($notif);

            return redirect('/admin/story/favorite/DataFavorite');
        } else {
            return back()->withInput();
        }
    }

    public function deleteFavorite($id)
    {
        $deleteRow = adminModel::deleteData(
            'favorites',
            'id_favorite',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
             <script>
             alert('Success Delete Data Favorite');
             window.location.href='/admin/story/favorite/DataFavorite';
             </script>
             ";
        } else {
            echo "
                 <script>
                 alert('Failed to Delete Data Favorite');
                 window.location.href='/admin/story/favorite/DataFavorite';
                 </script>
                 ";
        }


    }

    // end Favorite CRUD =========================================================================================================


    //  story CRUD =========================================================================================================
    public function read($id)
    {
        $data['reads'] = adminModel::getDataById('story', 'id_story', $id);
        return view('home/read/read', $data);
    }
    public function writteStories()
    {
        $data['genres'] = adminModel::getData('genre');
        // $data['categories'] = adminModel::getData('categories');
        return view('admin.story.story.AddStory', $data);
    }
    public function PostStories(Request $request)
    {
        $validation = $request->validate([
            // 'id_category' => 'required',
            'id_genre' => 'required',
            'title' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sinopsis' => 'required',
            'book_status' => 'required',
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
            'id_user' => auth()->user()->id,
            'created_at' => Carbon::now('Asia/Jakarta')
        ]);

        if (adminModel::CreateData('stories', $data)) {
            // Dapatkan id_story dari cerita yang baru saja disimpan
            $id_story = DB::table('stories')->latest('id_story')->first()->id_story;

            // Buat array data rating
            $rate = [
                'id_user' => auth()->user()->id,
                'id_story' => $id_story,
                'rate' => 0,
                'status' => 0,
                "created_at" => Carbon::now('Asia/Jakarta')
            ];

            // Simpan data rating awal
            adminModel::CreateData('rates', $rate);
            return redirect()->route('DataStory')->with('success', 'Successfully added new Story!');
        } else {
            return back()->withErrors(['Failed to add new Story']);
        }

    }

    public function editStory($id)
    {
        $data['data'] = adminModel::getDataById('stories', 'id_story', $id);
        $data['ShowGenre'] = adminModel::getDataById('genre', 'id_genre', $id);
        $data['genres'] = adminModel::getData('genre');
        // $data['categories'] = adminModel::getData('categories');
        return view('admin.story.story.EditStory', $data);
    }
    public function updateStory(Request $request, $id)
    {
        $validation = $request->validate([
            'id_genre' => 'required',
            // 'id_category' => 'required',
            'title' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sinopsis' => 'required',
            'book_status' => 'required',
        ]);

        $updatedata = adminModel::getDataById('stories', 'id_story', $id);

        $updatedata->id_genre = $validation['id_genre'];
        // $updatedata->id_category = 3;
        $updatedata->title = $validation['title'];
        $updatedata->id_user = auth()->user()->id;
        $updatedata->sinopsis = $validation['sinopsis'];
        $updatedata->book_status = $validation['book_status'];
        $updatedata->updated_at = now(); // or Carbon::now('Asia/Jakarta');

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
            return redirect('/admin/story/story/DataStory')->with('success', 'Product Updated Successfully!');
        } else {
            // Jika gagal, maka akan ditampilkan response gagal
            return response()->json(['messageFailed' => 'Gagal mengubah data']);
        }
    }

    public function deleteStory($id)
    {
        adminModel::deleteData('stories', 'id_story', $id);
        return redirect('/admin/story/story/DataStory')->with('Message', 'Success Delete Data Story');
    }

    public function updateStatus(Request $request, $id_story)
    {
        $selectedStatus = $request->input('selectedStatus');

        $data = array(
            'book_status' => $selectedStatus,
            'updated_at' => Carbon::now('Asia/Jakarta')
        );
        // Update status di model atau repository Anda
        adminModel::updateData('stories', 'id_story', $id_story, $data);

        // Beri respons jika perlu
        return response()->json(['message' => 'Status updated successfully']);

    }


    // user CRUD ==================================================================================================
    public function detailUser($id)
    {
        $data['user'] = adminModel::getDataById('users', 'id', $id);
        $data['roles'] = adminModel::getData('roles');

        // Count the number of stories for the user
        $data['story'] = adminModel::CountData('stories', 'id_story', $id);

        return view('admin.detailUser.detailUser', $data);
    }
    public function createUser()
    {
        $data['roles'] = adminModel::getData('roles');
        return view('admin.user.AddUser', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function PostUser(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'full_name' => [
                'required',
                Rule::unique('users')->ignore($request->id),
            ],
            'username' => [
                'required',
                Rule::unique('users')->ignore($request->id),
            ],
            'password' => 'required|string|max:255|confirmed',
            'phone_number' => 'required',
            'id_role' => 'required',
            'image_user' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ]);


        $uploadsPath = public_path('upload');
        if (!File::isDirectory($uploadsPath)) {
            File::makeDirectory($uploadsPath, 0777, true, true);
        }

        // Simpan gambar ke direktori public/uploads
        $image = $request->file('image_user');
        $imageName = $image->hashName();
        $image->move($uploadsPath, $imageName);


        $data = array_merge($validatedData, [
            'password' => bcrypt($validatedData['password']),
            'image_user' => $imageName,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);


        if (adminModel::createData('users', $data) == true) {
            return redirect()->route('DataUser')->with('success', 'User has been added');
        } else {
            return redirect()->route('createUser')->with('failed', 'User not added');

        }
    }
    public function PostImageUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image_user' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $uploadsPath = public_path('upload');
        if (!File::isDirectory($uploadsPath)) {
            File::makeDirectory($uploadsPath, 0777, true, true);
        }
        $updatedata = adminModel::getDataById('users', 'id', $id);

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
        // Assuming you want to update the currently logged in user's image
        $data = array_merge($validatedData, [

            'image_user' => $imageName,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);
        $updatedImageUser = adminModel::updateData('users', 'id', $id, $data);

        if ($updatedImageUser) {
            // $updatedUser is an object, use it as needed
            return redirect()->route('detailUser', ['id' => $id])->with('success-message', 'Updated-ImageUser.');
        } else {
            return back()->withInput()->with('failed', 'Please check the form again!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function editUser($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateUser(Request $request, $id)
    {
        $validation = $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'id_role' => 'required',
            'phone_number' => 'required|numeric'
        ]);


        $updateDataUser = adminModel::getDataById('users', 'id', $id);
        $updateDataUser->full_name = $validation['full_name'];
        $updateDataUser->email = $validation['email'];
        $updateDataUser->id_role = $validation['id_role'];
        $updateDataUser->phone_number = $validation['phone_number'];

        $executeUpdate = adminModel::updateData('users', 'id', $id, $updateDataUser);

        if ($executeUpdate) {
            return redirect()->route('detailUser', ['id' => $id])->with('success', 'Data User Successfully Updated.');
        } else {
            return back()->withInput();

        }
    }
    public function updateUserPassword(Request $request, $id)
    {
        $validation = $request->validate([
            'password' => 'required'
        ]);


        $updateDataUser = adminModel::getDataById('users', 'id', $id);
        $updateDataUser->password = $validation['password'];

        $executeUpdate = adminModel::updateData('users', 'id', $id, $updateDataUser);

        if ($executeUpdate) {
            return redirect()->route('detailUser', ['id' => $id])->with('success-password', 'Password-Update');
        } else {
            return back()->withInput();

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function deleteUser($id)
    {

        $deleteRow = adminModel::deleteData(
            'users',
            'id',
            [$id]
        );  //Menghapus row di tabel genre yang mem
        //iliki id=$id
        if ($deleteRow > 0) {
            echo "
            <script>
            alert('Success Delete Data Rate');
            window.location.href='/admin/user/DataUser';
            </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to Delete Data Rate');
                window.location.href='/admin/user/DataUser';
                </script>
                ";
        }
    }
}
