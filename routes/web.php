<?php

use App\Events\StatusLiked;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\admin\adminController;

use App\Http\Controllers\home\writterController;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\DetailStory\DetailStoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/maintenance', function () {
    Artisan::call('down', ['--secret' => 'panghaha']); // Sesuaikan dengan nama file halaman maintenance Anda
    dd(Artisan::output());

})->name('maintenance');

Route::get(
    '/disable-maintenance',
    function () {
        Artisan::call('up');
        // dd(Artisan::output());
    }
);
Route::get('/', [HomeController::class, 'index'])->name('StoryApps');


Route::get('/StoryList', [HomeController::class, 'storyList'])->name('storyList');

Route::get('/Auth', [AuthController::class, 'loginUser'])->name('loginUser');
Route::get('/Register', [AuthController::class, 'registerUser'])->name('registerUser');
Route::post('/Registers', [AuthController::class, 'regisUser'])->name('regisUser');
Route::post('/Auth/Login', [AuthController::class, 'authentication'])->name('LoginUserPost');

Route::get('/admin/', [AuthController::class, 'LoginAdmin'])->name('LoginAdmin');
Route::post('/admin/Auth', [AuthController::class, 'authentication'])->name('LoginAdminPost');
Route::get('/loadMore/{id}', [HomeController::class, 'loadMore'])->name('loadMore');

Auth::routes();
Route::group(['middleware' => ['Auth.user']], function () {

    Route::get('/Auth/logout', [AuthController::class, 'logout'])->name('logoutUser');
    Route::get('writter/writter', [writterController::class, 'writter'])->name('writter');
    Route::get('/registion', [writterController::class, 'registerWriter'])->name('registerWriter');
    // Writter
    Route::get('/profile/{id}', [writterController::class, 'profile'])->name('profile');

    // user/guest
    Route::get('/profile/{id}', [HomeController::class, 'profile'])->name('profile');
    // Route::get('writter/profileReader', [HomeController::class, 'profileReader'])->name('profileReader');
    Route::post('/home/send', [HomeController::class, 'send'])->name('send');
    Route::post('/home/sendRate', [HomeController::class, 'sendRate'])->name('sendRate');
    Route::post('/home/sendRate', [HomeController::class, 'storybygenre'])->name('storybygenre');
    Route::post('/favorite', [HomeController::class, 'favorite'])->name('favorite');
    Route::get('/listFavorite', [HomeController::class, 'listFavorite'])->name('listFavorite');
    Route::get('/genre/{genre}', [HomeController::class, 'StoryByGenre'])->name('StoryByGenre');

    Route::post('/edit-profil/{id}', [HomeController::class, 'UpdateUser'])->name('UpdateUser');

    Route::post('/edit-password/{id}', [HomeController::class, 'UpdatePassword'])->name('UpdatePassword');

    // CHAT STORY WHATSAPP
    Route::get('story/detailStory/{id}', [HomeController::class, 'detailStory'])->name('detailStory');
    Route::get('story/chatstory/{id}', [HomeController::class, 'ChatStory'])->name('ChatStory');
    Route::get('/loadMore/{id}', [HomeController::class, 'loadMore']);
    Route::get('/chapter/{id}', [HomeController::class, 'loadMore']);
});
Route::group(['middleware' => ['Auth.admin']], function () {
    Route::get('/admin/notification', [adminController::class, 'notification'])->name('notification');
    Route::get('/admin/ShowAllNotification', [adminController::class, 'ShowAllNotification'])->name('ShowAllNotification');
    Route::put('/admin/markNotificationAsRead/{id}', [adminController::class, 'markNotificationAsRead'])->name('markNotificationAsRead');
    Route::get('/admin/Dashboard', [adminController::class, 'index'])->name('Dashboard');
    Route::post('/admin/Auth/logout', [AuthController::class, 'logout'])->name('logout');


    // data master
    Route::get('/admin/user/DataUser', [adminController::class, 'DataUser'])->name('DataUser');
    Route::get('/admin/story/story/DataStory', [adminController::class, 'DataStory'])->name('DataStory');
    Route::get('/admin/Categories/DataCategories', [adminController::class, 'DataCategories'])->name('DataCategories');
    Route::get('/admin/story/rate/DataRate', [adminController::class, 'DataRate'])->name('DataRate');
    Route::get('/admin/story/comment/DataComment', [adminController::class, 'DataComment'])->name('DataComment');
    Route::get('/admin/story/favorite/DataFavorite', [adminController::class, 'DataFavorite'])->name('DataFavorite');
    Route::get('/admin/story/genre/DataGenre', [adminController::class, 'DataGenre'])->name('DataGenre');
    Route::get('/admin/story/chapters/DataChapters', [adminController::class, 'DataChapters'])->name('DataChapters');
    Route::get('/admin/story/characters/DataCharacters', [adminController::class, 'DataCharacters'])->name('DataCharacters');
    Route::get('/admin/story/dialog/DataDialog', [adminController::class, 'DataDialog'])->name('DataDialog');
    Route::get('/admin/company/DataCompany', [adminController::class, 'DataCompany'])->name('DataCompany');
    Route::get('/admin/contact/DataContact', [adminController::class, 'DataContact'])->name('DataContact');
    Route::get('/admin/faqs/DataFaqs', [adminController::class, 'DataFaqs'])->name('DataFaqs');

    // user
    Route::get('/admin/user/createUser', [adminController::class, 'createUser'])->name('createUser');
    Route::get('/admin/user/detail-user/{id}', [adminController::class, 'detailUser'])->name('detailUser');
    Route::get('/admin/ShowAllNotification', [adminController::class, 'ShowAllNotification'])->name('ShowAllNotification');
    Route::post('/admin/user/create-user/PostUser', [adminController::class, 'PostUser'])->name('PostUser');
    Route::post('/admin/user/create-image-user/PostImageUser/{id}', [adminController::class, 'PostImageUser'])->name('PostImageUser');
    // Route::get('/admin/user/edit-user/{id}', [adminController::class, 'editUser'])->name('editUser');
    Route::post('/admin/user/update-user/{id}', [adminController::class, 'updateUser'])->name('updateUser');
    Route::post('/admin/user/update-image-user/{id}', [adminController::class, 'updateImageUser'])->name('updateImageUser');
    Route::post('/admin/user/update-password-user/{id}', [adminController::class, 'updateUserPassword'])->name('updateUserPassword');
    Route::get('/admin/user/delete-user/{id}', [adminController::class, 'deleteUser'])->name('deleteUser');

    // company
    Route::get('/admin/company/createCompany', [adminController::class, 'createCompany'])->name('createCompany');
    Route::post('/admin/company/create-company/PostCompany', [adminController::class, 'PostCompany'])->name('PostCompany');
    Route::get('/admin/company/edit-company/{id}', [adminController::class, 'editCompany'])->name('editCompany');
    Route::post('/admin/company/update-company/{id}', [adminController::class, 'updateCompany'])->name('updateCompany');
    Route::get('/admin/company/delete-company/{id}', [adminController::class, 'deleteCompany'])->name('deleteCompany');
    Route::get('/admin/company/delete-company-ALl', [adminController::class, 'deleteAllCompanies'])->name('deleteAllCompanies');

    // contact
    Route::get('/admin/contact/createContact', [adminController::class, 'createContact'])->name('createContact');
    Route::post('/admin/contact/create-contact/PostContact', [adminController::class, 'PostContact'])->name('PostContact');
    Route::get('/admin/contact/edit-contact/{id}', [adminController::class, 'editContact'])->name('editContact');
    Route::post('/admin/contact/update-contact/{id}', [adminController::class, 'updateContact'])->name('updateContact');
    Route::get('/admin/contact/delete-contact/{id}', [adminController::class, 'deleteContact'])->name('deleteContact');

    // faqs
    Route::get('/admin/faqs/createFaqs', [adminController::class, 'createFaqs'])->name('createFaqs');
    Route::post('/admin/faqs/create-faqs/PostFaqs', [adminController::class, 'PostFaqs'])->name('PostFaqs');
    Route::get('/admin/faqs/edit-faqs/{id}', [adminController::class, 'editFaqs'])->name('editFaqs');
    Route::post('/admin/faqs/update-faqs/{id}', [adminController::class, 'updateFaqs'])->name('updateFaqs');
    Route::get('/admin/faqs/delete-faqs/{id}', [adminController::class, 'deleteFaqs'])->name('deleteFaqs');




    // category
    Route::get('/admin/categories/createCategories', [adminController::class, 'createCategories'])->name('createCategories');
    Route::post('/admin/categories/create-categories/PostCategories', [adminController::class, 'PostCategories'])->name('PostCategories');
    Route::get('/admin/categories/edit-categories/{id}', [adminController::class, 'editCategories'])->name('editCategories');
    Route::post('/admin/categories/update-categories/{id}', [adminController::class, 'updateCategories'])->name('updateCategories');
    Route::get('/admin/categories/delete-categories/{id}', [adminController::class, 'deleteCategories'])->name('deleteCategories');

    // genre
    Route::get('/admin/story/createGenre', [adminController::class, 'createGenre'])->name('createGenre');
    Route::post('/admin/story/create-genre/PostGenre', [adminController::class, 'PostGenre'])->name('PostGenre');
    Route::get('/admin/story/edit-genre/{id}', [adminController::class, 'editGenre'])->name('editGenre');
    Route::post('/admin/story/update-genre/{id}', [adminController::class, 'updateGenre'])->name('updateGenre');
    Route::get('/admin/story/delete-genre/{id}', [adminController::class, 'deleteGenre'])->name('deleteGenre');

    // story
    Route::get('/admin/writteStories', [adminController::class, 'writteStories'])->name('writteStories');
    Route::post('/admin/writter-create/PostStories', [adminController::class, 'PostStories'])->name('PostStories');
    Route::put('/admin/ubah-status/{id_story}', [adminController::class, 'updateStatus'])->name('UbahStatus');
    Route::get('/admin/edit-story/{id_story}', [adminController::class, 'editStory'])->name('editStory');
    Route::post('/admin/update-story/{id_story}', [adminController::class, 'updateStory'])->name('updateStory');
    Route::get('/admin/delete-story/{id_story}', [adminController::class, 'deleteStory'])->name('deleteStory');
    Route::get('/admin/read/read/{id_story}', [adminController::class, 'read'])->name('read');


    // chapters
    Route::get('/admin/story/createChapters', [adminController::class, 'createChapters'])->name('createChapters');
    Route::post('/admin/story/create-chapters/PostChapter', [adminController::class, 'PostChapter'])->name('PostChapter');
    Route::get('/admin/story/edit-chapters/{id}', [adminController::class, 'editChapter'])->name('editChapter');
    Route::post('/admin/story/update-chapters/{id}', [adminController::class, 'updateChapter'])->name('updateChapter');
    Route::get('/admin/story/delete-chapters/{id}', [adminController::class, 'deleteChapter'])->name('deleteChapter');

    // characters
    Route::get('/admin/story/createCharacters', [adminController::class, 'createCharacters'])->name('createCharacters');
    Route::post('/admin/story/create-characters/PostCharacter', [adminController::class, 'PostCharacter'])->name('PostCharacter');
    Route::get('/admin/story/edit-characters/{id}', [adminController::class, 'editCharacter'])->name('editCharacter');
    Route::post('/admin/story/update-characters/{id}', [adminController::class, 'updateCharacter'])->name('updateCharacter');
    Route::get('/admin/story/delete-characters/{id}', [adminController::class, 'deleteCharacter'])->name('deleteCharacter');

    // dialog
    Route::get('/admin/story/createDialog', [adminController::class, 'createDialog'])->name('createDialog');
    Route::get('/get-characters', [adminController::class, 'GetDialog'])->name('GetDialog');
    Route::post('/admin/story/create-dialog/PostDialog', [adminController::class, 'PostDialog'])->name('PostDialog');
    Route::get('/admin/story/edit-dialog/{id}', [adminController::class, 'editDialog'])->name('editDialog');
    Route::post('/admin/story/update-dialog/{id}', [adminController::class, 'updateDialog'])->name('updateDialog');
    Route::get('/admin/story/delete-dialog/{id}', [adminController::class, 'deleteDialog'])->name('deleteDialog');

    // rate
    Route::get('/admin/story/createRate', [adminController::class, 'createRate'])->name('createRate');
    Route::post('/admin/story/create-rate/PostRate', [adminController::class, 'PostRate'])->name('PostRate');
    Route::PUT('/admin/story/rate/rateStory/{id}', [adminController::class, 'rateStory'])->name('rateStory');
    Route::get('/admin/story/edit-rate/{id}', [adminController::class, 'editRate'])->name('editRate');
    Route::post('/admin/story/update-rate/{id}', [adminController::class, 'updateRate'])->name('updateRate');
    Route::get('/admin/story/delete-rate/{id}', [adminController::class, 'deleteRate'])->name('deleteRate');

    // comment
    Route::get('/admin/story/comment/createComment', [adminController::class, 'createComment'])->name('createComment');
    Route::post('/admin/story/comment/create-comment/PostComment', [adminController::class, 'PostComment'])->name('PostComment');
    Route::get('/admin/story/comment/edit-comment/{id}', [adminController::class, 'editComment'])->name('editComment');
    Route::post('/admin/story/comment/update-comment/{id}', [adminController::class, 'updateComment'])->name('updateComment');
    Route::get('/admin/story/comment/delete-comment/{id}', [adminController::class, 'deleteComment'])->name('deleteComment');

    // favorite
    Route::get('/admin/story/favorite/createFavorite', [adminController::class, 'createFavorite'])->name('createFavorite');
    Route::post('/admin/story/favorite/create-favorite/PostFavorite', [adminController::class, 'PostFavorite'])->name('PostFavorite');
    Route::get('/admin/story/favorite/edit-favorite/{id}', [adminController::class, 'editFavorite'])->name('editFavorite');
    Route::post('/admin/story/favorite/update-favorite/{id}', [adminController::class, 'updateFavorite'])->name('updateFavorite');
    Route::get('/admin/story/favorite/delete-favorite/{id}', [adminController::class, 'deleteFavorite'])->name('deleteFavorite');

    // Route::get('/get-characters', [adminController::class, 'GetDialog'])->name('GetDialog');

});
