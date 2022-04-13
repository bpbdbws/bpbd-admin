<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaBencana extends Model
{
    use HasFactory;

    protected $table = 'berita_bencana';
    protected $primaryKey = 'id';
}
