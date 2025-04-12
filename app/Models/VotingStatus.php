<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotingStatus extends Model
{
    protected $fillable = ['name', 'is_active'];
}
