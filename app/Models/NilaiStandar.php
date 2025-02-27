<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiStandar extends Model
{
  use HasFactory;

  protected $table = 'nilai_standar';

  protected $fillable = ['kriteria', 'nilai_ideal'];
}
