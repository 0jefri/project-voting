<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $table = 'voting';

    protected $fillable = [
        'id_user', // ID pemilih
        'id_kandidat', // ID kandidat yang dipilih
        'waktu_vote', // Timestamp kapan pemilih melakukan voting
    ];

    /**
     * Relasi ke tabel users untuk mendapatkan data pemilih
     */
    public function pemilih()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Relasi ke tabel kandidat untuk mendapatkan data kandidat yang dipilih
     */
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class, 'id_kandidat', 'id');
    }

    /**
     * Mendapatkan daftar user yang sudah vote
     */
    public static function getUsersWhoVoted()
    {
        return self::pluck('id_user')->unique()->toArray();
    }

    /**
     * Mendapatkan daftar user yang belum vote
     */
    public static function getUsersWhoHaveNotVoted()
    {
        $allUsers = User::pluck('id')->toArray();
        $votedUsers = self::getUsersWhoVoted();
        return array_diff($allUsers, $votedUsers);
    }
}
