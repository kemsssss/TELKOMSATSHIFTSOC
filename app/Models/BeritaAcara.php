<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $fillable = [
        'petugas_lama_id',
        'petugas_baru_id',
        'tanggal_shift',
        'tiket_nomor',
        'soar_sangfor',
        'soar_fortijtn',
        'soar_fortiweb',
        'soar_checkpoint',
        'sophos_ip',
        'sophos_url',
        'vpn',
        'edr',
        'magnus',
        'lama_ttd',
        'baru_ttd',
    ];

    protected $casts = [
        'sophos_ip' => 'array',
        'sophos_url' => 'array',
        'vpn' => 'array',
        'edr' => 'array',
        'magnus' => 'array',
    ];
}
