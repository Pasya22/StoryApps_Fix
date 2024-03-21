<?php

namespace App\Models;



use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class adminModel extends Model
{
    use HasFactory;
    protected $tables = 'rates';
    public static function getData($table)
    {
        return DB::table($table)->get();
    }
    public static function getData2($table)
    {
        return DB::table($table)->get();
    }
    public static function getData3($table, $fieldColumn)
    {
        return DB::table($table)->orderBy($fieldColumn, 'desc')->get();
    }
    public static function getData4($table, $fieldColumn, $bool)
    {
        return DB::table($table)->where($fieldColumn, $bool)->orderBy('id_rate', 'desc')->get();
    }
    public static function getData5($table, $fieldColumn, $fieldColumn2)
    {
        return DB::table('favorites')->where($fieldColumn)->where($fieldColumn2)->get();
    }
    public static function GetDataPagenation($table, $fieldColumn)
    {
        // return DB::table('users')->select('users.*', 'roles.id_role','roles.role')->join('roles', 'roles.id_role','users.id_role')->orderBy('id', 'desc')->paginate(5);

        return DB::table($table)->orderBy($fieldColumn, 'desc')->paginate(5);

    }
    public static function GetDataPagenation2()
    {
        return DB::table('users')->select('users.*', 'roles.id_role', 'roles.role')->join('roles', 'roles.id_role', 'users.id_role')->orderBy('id', 'desc')->paginate(5);

        // return DB::table($table)->orderBy($fieldColumn, 'desc')->paginate(5);

    }

    public static function updateStatus($id_story, $selectedStatus, $date)
    {

        DB::table('stories')->where('id_story', $id_story)->update(['book_status' => $selectedStatus, 'updated_at' => $date]);
    }
    public static function updateRate($id_rate, $Rate)
    {

        DB::table('rates')->where('id_rate', $id_rate)->update(['rate' => $Rate]);
    }
    public static function CountData($table, $fieldColumn, $id)
    {
        return DB::table($table)->where($fieldColumn, $id)->count();
    }
    public static function getDataById($table, $fieldColumn, $id)
    {
        return DB::table($table)->where($fieldColumn, $id)->first();
    }
    public static function getDataById2($table, $fieldColumn, $id)
    {
        return DB::table($table)->where($fieldColumn, $id)->get();
    }
    public static function GetEmail($table, $fieldColumn, $email)
    {
        return DB::table($table)->where($fieldColumn, $email)->first();
    }
    public static function GetRate($table, $fieldColumn, $rate)
    {
        return DB::table($table)->where($fieldColumn, $rate)->first();
    }
    public static function CreateData($table, $data)
    {
        return DB::table($table)->insert($data);
    }
    public static function updateData($table, $idColumn, $idValue, $data)
    {
        // Ubah data objek stdClass menjadi array
        $dataArray = (array) $data;

        // Perbarui data
        return DB::table($table)->where($idColumn, $idValue)->update($dataArray);
    }
    public static function deleteData($table, $idColumn, $id)
    {
        return DB::table($table)->where($idColumn, $id)->delete();
    }
    public static function deleteAllData($table)
    {
        return DB::table($table)->truncate();
    }




    // join data

    // notifkasi

    // end notifikasi
    // public static function detailChaptersStory($id)
    // {
    //     $DetailStoryByChapters = DB::table('chapters')
    //     ->select('chapters.*','stories.*','characters.*','chapters.*');
    // } belum selesai

    public static function GetDataRequestWriter()
    {

        $joinData = DB::table('requestWriter')->select('users.*', 'roles.*', 'requestWriter.*')->join('users', 'users.id', 'requestWriter.id_user')->join('roles', 'roles.id_role', 'requestWriter.id_role')->orderBy('id_request', 'desc')->paginate(5);
        return $joinData;
    }
    public static function GetDataRequestBeWriter()
    {
        return DB::table('users')->select('users.*', 'roles.id_role', 'roles.role')->join('roles', 'roles.id_role', 'users.id_role')->where('id');

    }
    public static function StoryByChapters($id)
    {
        $joinData = DB::table('chapters')->select('stories.*', 'chapters.*')->join('stories', 'stories.id_story', 'chapters.id_story')->where('id_chapter', $id)->orderBy('id_chapter', 'desc')->first();
        return $joinData;
    }
    public static function StoryChapters()
    {
        $joinData = DB::table('chapters')->select('stories.*', 'chapters.*')->join('stories', 'stories.id_story', 'chapters.id_story')->orderBy('id_chapter', 'desc')->paginate(5);

        return $joinData;
    }
    // public static function StoryGenre()
    // {
    //     $joinData = DB::table('stories')->select('genre.*', 'stories.*')->join('genre', 'genre.id_genre', 'stories.id_genre')->orderBy('id_story', 'desc')->paginate(5);

    //     return $joinData;
    // }
    public static function StoryGenre()
    {
        $joinData = DB::table('stories')
            ->select(
                'genre.id_genre as genre_id',
                'genre.genre as genre_name',
                'stories.*',
                DB::raw('COUNT(DISTINCT chapters.id_chapter) as jumlah_chapter'),
                DB::raw('COUNT(characters.id_character) as jumlah_character'),
                DB::raw('COUNT(dialogs.id_dialog) as jumlah_dialog')
            )
            ->join('genre', 'genre.id_genre', 'stories.id_genre')
            ->leftJoin('chapters', 'chapters.id_story', 'stories.id_story')
            ->leftJoin('characters', 'characters.id_chapter', 'chapters.id_chapter')
            ->leftJoin('dialogs', 'dialogs.id_character', 'characters.id_character')
            ->orderBy('stories.id_story', 'desc')
            ->groupBy('stories.id_story')
            ->paginate(5);

        foreach ($joinData as $story) {
            // Calculate the total number of dialogs and characters
            $totalDialogs = $story->jumlah_dialog; // Total number of dialogs
            $totalCharacters = $story->jumlah_character; // Total number of characters


            // Calculate the total number of pages
            $story->jumlah_halaman_dialogs = ceil($totalDialogs / 10); // 10 dialogs per page
            $story->jumlah_halaman_characters = ceil($totalCharacters / 10); // 10 characters per page

            // Total number of pages for both dialogs and characters
            $story->jumlah_halaman_total = $story->jumlah_halaman_dialogs + $story->jumlah_halaman_characters;
        }

        return $joinData;


    }



    public static function UserCommentsStory()
    {
        $joinData = DB::table('comments')->select('comments.*', 'users.*', 'stories.*')->join('stories', 'stories.id_story', 'comments.id_story')->join('users', 'users.id', 'comments.id_user')->orderBy('id_comment', 'desc')->paginate(5);

        return $joinData;
    }
    public static function UserRateStory()
    {
        $joinData = DB::table('rates')->select('rates.*', 'stories.*', 'users.*')->join('stories', 'stories.id_story', 'rates.id_story')->join('users', 'users.id', 'rates.id_user')->orderBy('id_rate', 'desc')->paginate(5);

        return $joinData;
    }
    public static function UserFavoriteStory()
    {
        $joinData = DB::table('favorites')->select('favorites.*', 'stories.*', 'users.*')->join('stories', 'stories.id_story', 'favorites.id_story')->join('users', 'users.id', 'favorites.id_user')->orderBy('id_favorite', 'desc')->paginate(5);

        return $joinData;
    }
    public static function UserFavoriteStory2()
    {
        $joinData = DB::table('favorites')->select('favorites.*', 'stories.*', 'users.*')->join('stories', 'stories.id_story', 'favorites.id_story')->join('users', 'users.id', 'favorites.id_user')->get();

        return $joinData;
    }
    public static function CharacterStoryChapters()
    {
        $joinData = DB::table('characters')->select('chapters.*', 'stories.*', 'characters.*')->join('chapters', 'chapters.id_chapter', 'characters.id_chapter')->join('stories', 'stories.id_story', 'characters.id_story')->orderBy('id_character', 'desc')->paginate(5);

        return $joinData;
        # code...
    }


    public static function StoryFavoritUser($id)
    {
        // Fetching data for the given chapter with joins
        $query = DB::table('favorites')
            ->join('stories', 'favorites.id_story', '=', 'stories.id_story')
            ->leftJoin('rates', 'stories.id_story', '=', 'rates.id_story')
            ->leftJoin('genre', 'stories.id_genre', '=', 'genre.id_genre')
            ->join('users', 'favorites.id_user', '=', 'users.id')
            ->select(
                'stories.id_story',
                'stories.title',
                'stories.sinopsis',
                'stories.book_status',
                'stories.images',
                'users.id_role',
                'users.full_name',
                // 'categories.*',
                'genre.genre',
                'favorites.favorit',
                'favorites.id_favorite',
                DB::raw('
            SUM(CASE WHEN rate = 1 THEN 1 ELSE 0 END) as count_1,
            SUM(CASE WHEN rate = 2 THEN 2 ELSE 0 END) as count_2,
            SUM(CASE WHEN rate = 3 THEN 3 ELSE 0 END) as count_3,
            SUM(CASE WHEN rate = 4 THEN 4 ELSE 0 END) as count_4,
            SUM(CASE WHEN rate = 5 THEN 5 ELSE 0 END) as count_5,
            COUNT(*) as total_ratings,
            IF(COUNT(*) > 0, SUM(rate) / COUNT(*), 0) as average_rating
        ')
            )


            ->where('users.id', $id)

            ->groupBy('stories.id_story', 'stories.title', 'stories.sinopsis', 'stories.book_status', 'stories.images', 'genre.genre', 'users.id_role', 'users.full_name', 'favorites.favorit', 'favorites.id_favorite')
            ->orderBy('favorites.id_favorite', 'Desc');
        // Order by story ID in descending order


        // Paginate the query
        $stories = $query->paginate(10); // 10 adalah jumlah data yang akan ditampilkan per halaman

        return $stories;
    }
    public static function joinData($chapterId, $perPage = 5)
    {
        // Fetching data for the given chapter with joins
        $query = DB::table('chapters')
            ->select('stories.*', 'characters.*', 'dialogs.*', 'chapters.*')
            ->join('stories', 'chapters.id_story', '=', 'stories.id_story')
            ->join('characters', 'chapters.id_chapter', '=', 'characters.id_chapter')
            ->join('dialogs', 'characters.id_character', '=', 'dialogs.id_character')
            ->where('chapters.id_chapter', $chapterId)
            ->orderBy('dialogs.id_dialog');

        // Paginate the query
        $dialogs = $query->paginate($perPage);

        return $dialogs;
    }
    public static function GetSinopsis($idChapter, $perPage = 10)
    {
        return DB::table('chapters')
            ->join('stories', 'chapters.id_story', '=', 'stories.id_story')
            ->join('characters', 'chapters.id_chapter', '=', 'characters.id_chapter')
            ->join('dialogs', 'characters.id_character', '=', 'dialogs.id_character')
            ->where('chapters.id_chapter', $idChapter)
            ->orderBy('dialogs.id_dialog')
            ->paginate($perPage);
    }

    // public static function GetSinopsis($idChapter, $perPage = 5)
    // {
    //     $dialogs = DB::table('chapters')
    //         ->join('stories', 'chapters.id_story', '=', 'stories.id_story')
    //         ->join('characters', 'chapters.id_chapter', '=', 'characters.id_chapter')
    //         ->join('dialogs', 'characters.id_character', '=', 'dialogs.id_character')
    //         ->where('chapters.id_chapter', $idChapter)
    //         ->orderBy('dialogs.id_dialog')
    //         ->paginate($perPage);

    //     // Reformatting dialog data to separate left and right side dialogues
    //     $formattedDialogs = [];
    //     $leftDialogs = [];
    //     $rightDialogs = [];
    //     foreach ($dialogs->items() as $key => $dialog) {
    //         if ($key % 2 == 0) {
    //             $leftDialogs[] = $dialog;
    //         } else {
    //             $rightDialogs[] = $dialog;
    //         }
    //     }

    //     // Merging left and right dialogues into a single array
    //     foreach ($leftDialogs as $key => $leftDialog) {
    //         $formattedDialogs[] = $leftDialog;
    //         if (isset($rightDialogs[$key])) {
    //             $formattedDialogs[] = $rightDialogs[$key];
    //         }
    //     }

    //     // Replace the original dialog data with formatted dialog data
    //     $dialogs->items($formattedDialogs);

    //     return $dialogs;

    // }


    public static function DialogCharactersStoryChapters()
    {
        $joinData = DB::table('dialogs')->select('chapters.*', 'stories.*', 'characters.*', 'dialogs.*')
            ->join('chapters', 'chapters.id_chapter', 'dialogs.id_chapter')
            ->join('stories', 'stories.id_story', 'dialogs.id_story')
            ->join('characters', 'characters.id_character', 'dialogs.id_character')
            ->orderBy('id_dialog', 'desc')
            ->paginate(5);

        return $joinData;
    }
    public static function StoryUserRate()
    {
        $users = DB::table('rates')
            ->join('stories', 'stories.id_story', '=', 'rates.id_story')
            ->join('users', 'users.id', '=', 'rates.id_user')
            ->select('users.*', 'stories.*', 'rates.*')
            ->orderBy('rates.created_at', 'desc')->paginate(5);
        // or use paginate() if you want pagination

        return $users;
    }
    public static function StoryListByGenre($id)
    {
        $counts = DB::table('stories')
            ->leftJoin('rates', 'stories.id_story', '=', 'rates.id_story')
            ->leftJoin('genre', 'genre.id_genre', '=', 'stories.id_genre')
            // ->leftJoin('categories', 'categories.id_category', '=', 'stories.id_category')
            ->leftJoin('users', 'users.id', '=', 'stories.id_user')
            ->select(
                'stories.id_story',
                'stories.title',
                'stories.sinopsis',
                'stories.book_status',
                'stories.images',
                'users.id_role',
                'users.full_name',
                // 'categories.*',
                'genre.genre',
                DB::raw('
            SUM(CASE WHEN rate = 1 THEN 1 ELSE 0 END) as count_1,
            SUM(CASE WHEN rate = 2 THEN 2 ELSE 0 END) as count_2,
            SUM(CASE WHEN rate = 3 THEN 3 ELSE 0 END) as count_3,
            SUM(CASE WHEN rate = 4 THEN 4 ELSE 0 END) as count_4,
            SUM(CASE WHEN rate = 5 THEN 5 ELSE 0 END) as count_5,
            COUNT(*) as total_ratings,
            IF(COUNT(*) > 0, SUM(rate) / COUNT(*), 0) as average_rating
        ')
            )
            ->where('genre.genre', '=', $id)
            // ->havingRaw('total_ratings = 0 OR average_rating < 4')
            ->groupBy('stories.id_story', 'stories.title', 'stories.sinopsis', 'stories.book_status', 'stories.images', 'genre.genre', 'users.id_role', 'users.full_name')
            ->orderBy('stories.id_story', 'desc') // Order by story ID in descending order
            ->get();

        return $counts;
    }
    public static function getStoryDetail($id)
    {
        $storyDetail = DB::table('stories')
            ->leftJoin('rates', 'stories.id_story', '=', 'rates.id_story')
            ->leftJoin('genre', 'genre.id_genre', '=', 'stories.id_genre')
            ->leftJoin('users', 'users.id', '=', 'stories.id_user')
            ->leftJoin('chapters', 'chapters.id_story', '=', 'stories.id_story')
            ->select(
                'stories.id_story',
                'stories.title',
                'stories.sinopsis',
                'stories.book_status',
                'stories.images',
                'stories.created_at',
                'users.id_role',
                'users.full_name',
                'genre.genre',
                'chapters.chapter',
                'chapters.id_chapter',
                DB::raw('
                SUM(CASE WHEN rate = 1 THEN 1 ELSE 0 END) as count_1,
                SUM(CASE WHEN rate = 2 THEN 2 ELSE 0 END) as count_2,
                SUM(CASE WHEN rate = 3 THEN 3 ELSE 0 END) as count_3,
                SUM(CASE WHEN rate = 4 THEN 4 ELSE 0 END) as count_4,
                SUM(CASE WHEN rate = 5 THEN 5 ELSE 0 END) as count_5,
                COUNT(*) as total_ratings,
                IF(COUNT(*) > 0, SUM(rate) / COUNT(*), 0) as average_rating
            ')
            )
            ->where('stories.id_story', $id)
            // ->groupBy('stories.id_story', 'stories.title', 'genre.id_genre', 'users.id', 'chapters.id_chapter')
            ->groupBy('stories.id_story', 'stories.title', 'stories.sinopsis', 'stories.book_status', 'stories.created_at', 'stories.images', 'genre.genre', 'users.id_role', 'users.full_name', 'chapters.chapter', 'chapters.id_chapter', 'stories.id_genre')
            ->first(); // Gunakan first() untuk mendapatkan satu baris hasil

        return $storyDetail;
    }

    public static function CountDataRate()
    {
        $counts = DB::table('rates')
            ->join('stories', 'stories.id_story', '=', 'rates.id_story')
            ->join('genre', 'genre.id_genre', '=', 'stories.id_genre')
            // ->leftJoin('categories', 'categories.id_category', '=', 'stories.id_category')
            ->join('users', 'users.id', '=', 'stories.id_user')
            ->select(
                'stories.id_story',
                'stories.title',
                'stories.sinopsis',
                'stories.book_status',
                'stories.images',
                'users.id_role',
                'users.full_name',
                // 'categories.*',
                'genre.genre',
                DB::raw('
                SUM(CASE WHEN rate = 1 THEN 1 ELSE 0 END) as count_1,
                SUM(CASE WHEN rate = 2 THEN 2 ELSE 0 END) as count_2,
                SUM(CASE WHEN rate = 3 THEN 3 ELSE 0 END) as count_3,
                SUM(CASE WHEN rate = 4 THEN 4 ELSE 0 END) as count_4,
                SUM(CASE WHEN rate = 5 THEN 5 ELSE 0 END) as count_5,
                COUNT(*) as total_ratings,
                IF(COUNT(*) > 0, SUM(rate) / COUNT(*), 0) as average_rating
            ')
            )

            ->groupBy('stories.id_story', 'stories.title', 'stories.sinopsis', 'stories.book_status', 'stories.images', 'genre.genre', 'users.id_role', 'users.full_name')
            ->orderBy('stories.id_story', 'desc') // Order by story ID in descending order
            ->get();

        return $counts;
    }
    public static function NewStoryRate()
    {

        $counts = DB::table('stories')
            ->leftJoin('rates', 'stories.id_story', '=', 'rates.id_story')
            ->leftJoin('genre', 'genre.id_genre', '=', 'stories.id_genre')
            // ->leftJoin('categories', 'categories.id_category', '=', 'stories.id_category')
            ->leftJoin('users', 'users.id', '=', 'stories.id_user')
            ->select(
                'stories.id_story',
                'stories.title',
                'stories.sinopsis',
                'stories.book_status',
                'stories.images',
                'users.id_role',
                'users.full_name',
                // 'categories.*',
                'genre.genre',
                DB::raw('
                SUM(CASE WHEN rate = 1 THEN 1 ELSE 0 END) as count_1,
                SUM(CASE WHEN rate = 2 THEN 2 ELSE 0 END) as count_2,
                SUM(CASE WHEN rate = 3 THEN 3 ELSE 0 END) as count_3,
                SUM(CASE WHEN rate = 4 THEN 4 ELSE 0 END) as count_4,
                SUM(CASE WHEN rate = 5 THEN 5 ELSE 0 END) as count_5,
                COUNT(*) as total_ratings,
                IF(COUNT(*) > 0, SUM(rate) / COUNT(*), 0) as average_rating
            ')
            )
            // ->where('stories.book_status', '=', 1)
            ->havingRaw('total_ratings > 0')
            // ->havingRaw('total_ratings = 0 OR average_rating < 4')
            ->groupBy('stories.id_story', 'stories.title', 'stories.sinopsis', 'stories.book_status', 'stories.images', 'genre.genre', 'users.id_role', 'users.full_name')
            ->orderBy('stories.id_story', 'desc') // Order by story ID in descending order
            ->get();

        return $counts;
    }
    public static function RateStoryPopuler()
    {
        $counts = DB::table('stories')
            ->leftJoin('rates', 'stories.id_story', '=', 'rates.id_story')
            ->leftJoin('genre', 'genre.id_genre', '=', 'stories.id_genre')
            ->leftJoin('users', 'users.id', '=', 'stories.id_user')
            ->select(
                'stories.id_story',
                'stories.title',
                'stories.sinopsis',
                'stories.book_status',
                'stories.images',
                'users.id_role',
                'users.full_name',
                // 'categories.*',
                'genre.genre',
                DB::raw('
                    SUM(CASE WHEN rate = 1 THEN 1 ELSE 0 END) as count_1,
                    SUM(CASE WHEN rate = 2 THEN 1 ELSE 0 END) as count_2,
                    SUM(CASE WHEN rate = 3 THEN 1 ELSE 0 END) as count_3,
                    SUM(CASE WHEN rate = 4 THEN 1 ELSE 0 END) as count_4,
                    SUM(CASE WHEN rate = 5 THEN 1 ELSE 0 END) as count_5,
                    COUNT(rates.id_user) as total_ratings,
                    IFNULL((SUM(rate) / COUNT(rates.id_user)), 0) as average_rating,
                    COUNT(DISTINCT rates.id_user) as total_rates_given,
                    MAX(rates.created_at) as last_rating_date
                ')
            )
            ->groupBy('stories.id_story', 'stories.title', 'stories.sinopsis', 'stories.book_status', 'stories.images', 'genre.genre', 'users.id_role', 'users.full_name')
            ->havingRaw('total_ratings > 0') // Hanya cerita dengan setidaknya satu rating
            // ->orderByDesc('total_ratings')
            // ->orderByDesc('average_rating')
            ->orderBy('stories.id_story', 'desc')
            ->limit(10)
            ->get();

        return $counts;
    }


    public static function RateRecomendationStory($userId)
    {
        if ($userId) {
            $userRatedStories = DB::table('rates')
                ->select('id_story')
                ->where('id_user', '=', $userId)
                ->pluck('id_story');

            $recommendations = DB::table('stories')
                ->leftJoin('genre', 'stories.id_genre', '=', 'genre.id_genre')
                ->leftJoin('users', 'stories.id_user', '=', 'users.id')
                ->leftJoin('rates', 'stories.id_story', '=', 'rates.id_story')
                ->select(
                    'stories.id_story',
                    'stories.title',
                    'stories.sinopsis',
                    'stories.book_status',
                    'stories.images',
                    'users.username as username',
                    'users.full_name as full_name',
                    'genre.genre as genre',
                    DB::raw('AVG(rates.rate) as average_rating')
                )
                ->whereIn('stories.id_story', $userRatedStories)
                ->where('genre.genre', function ($query) use ($userRatedStories) {
                    $query->select('genre.genre')
                        ->from('stories')
                        ->join('genre', 'stories.id_genre', '=', 'genre.id_genre')
                        ->whereIn('stories.id_story', $userRatedStories)
                        ->groupBy('genre.genre')
                        ->orderByRaw('COUNT(*) DESC')
                        ->limit(1);
                })
                ->groupBy('stories.id_story', 'stories.title', 'stories.sinopsis', 'stories.book_status', 'stories.images', 'genre.genre', 'users.id_role', 'users.username', 'users.full_name')
                ->havingRaw('average_rating >= 4')
                ->orderBy('stories.id_story', 'desc')
                ->limit(10)
                ->get();

        } else {
            $recommendations = DB::table('stories')
                ->leftJoin('genre', 'stories.id_genre', '=', 'genre.id_genre')
                ->leftJoin('users', 'stories.id_user', '=', 'users.id')
                ->leftJoin('rates', 'stories.id_story', '=', 'rates.id_story')
                ->select(
                    'stories.id_story',
                    'stories.title',
                    'stories.sinopsis',
                    'stories.book_status',
                    'stories.images',
                    'users.id_role',
                    // 'categories.*',
                    'users.username as username',
                    'users.full_name as full_name',
                    'genre.genre as genre',
                    DB::raw('AVG(rates.rate) as average_rating')
                )
                ->groupBy('stories.id_story', 'stories.title', 'stories.sinopsis', 'users.username', 'users.full_name', 'stories.book_status', 'stories.images', 'genre.genre', 'users.id_role')
                ->havingRaw('average_rating >= 4 OR average_rating IS NULL') // Include cerita tanpa peringkat
                ->orderBy('average_rating', 'desc') // Urutkan berdasarkan peringkat rata-rata dari tertinggi ke terendah
                ->limit(10) // Batasi jumlah cerita yang ditampilkan menjadi 10
                ->get();
        }

        return $recommendations;
    }

    public static function getUnreadNotifications()
    {
        return DB::table('notifications')
            ->select('notifications.*', 'users.*', 'stories.*', 'requestWriter.*') // Sesuaikan kolom yang Anda butuhkan
            ->join('users', 'users.id', '=', 'notifications.id_user')
            ->leftJoin('stories', 'stories.id_story', '=', 'notifications.entity_id') // Join dengan tabel cerita (stories)
            ->leftJoin('requestWriter', 'requestWriter.id_request', '=', 'notifications.entity_id2') // Join dengan tabel cerita (stories)
            ->where('notifications.is_read', 0) // Hanya notifikasi yang belum dibaca
            // ->orWhere('is_read', false)
            ->orderByDesc('notifications.id_notification')
            ->limit(5)
            ->get();
    }
    public static function markNotificationAsReads($id)
    {

        return DB::table('notifications')
            ->where('id_notification', $id)
            ->update(['is_read' => 1]);

    }
    public static function countUnreadNotifications()
    {
        return DB::table('notifications')
            ->where('is_read', 0) // Hanya notifikasi yang belum dibaca
            // ->orWhere('is_read', false)
            ->count();
    }

    public static function DataDashboard()
    {
        $data = array(
            // 'users' => DB::table('users')->count(),
            'writters' => DB::table('users')->where('id_role', 2)->count(),
            'users' => DB::table('users')->where('id_role', 3)->count(),
            'stories' => DB::table('stories')->count(),
            'rate' => DB::table('rates')->count(),
        );
        return $data;
    }
}
