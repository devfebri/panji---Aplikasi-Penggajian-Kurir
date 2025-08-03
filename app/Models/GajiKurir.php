<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKurir extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gaji_kurir';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kurir_id',
        'tanggal_kerja',
        'pikup',
        'pud',
        'total'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_kerja' => 'date',
        'pikup' => 'integer',
        'pud' => 'integer',
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the kurir that owns the gaji kurir.
     */
    public function kurir()
    {
        return $this->belongsTo(User::class, 'kurir_id');
    }

    /**
     * Get formatted pikup
     */
    public function getFormattedPikupAttribute()
    {
        return number_format($this->pikup, 0, ',', '.');
    }

    /**
     * Get formatted pud
     */
    public function getFormattedPudAttribute()
    {
        return number_format($this->pud, 0, ',', '.');
    }

    /**
     * Get formatted total
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    /**
     * Get formatted tanggal kerja
     */
    public function getFormattedTanggalKerjaAttribute()
    {
        return $this->tanggal_kerja->format('d M Y');
    }
}
