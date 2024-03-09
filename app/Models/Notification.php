<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'id_user',
        'message',
        'type',
        'sender_id',
        'entity_id', // tambahkan entity_id ke fillable
        'is_read',   // tambahkan is_read ke fillable
        'created_at',
    ];

    public static function insertNotification($data)
    {
        return DB::table('notifications')->insert([
            'id_user' => $data['id_user'],
            'message' => $data['message'],
            'type' => $data['type'],
            'sender_id' => $data['sender_id'],
            'entity_id' => $data['entity_id'],
            'created_at' => $data['created_at'],
        ]);
    }
    public static function markNotificationAsReads($id)
    {
        return DB::table('notifications')
            ->where('id_notification', $id)
            ->update(['is_read' => 1]); // Setel is_read menjadi 1 untuk menandai notifikasi telah dibaca
    }

}
