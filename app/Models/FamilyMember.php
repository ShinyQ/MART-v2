<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    public $fillable = [
        'family_card_id', 'nama', 'nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'agama', 'pendidikan', 'pekerjaan', 'golongan_darah', 'isFamilyHead', 'family_card_id'
    ];
}
