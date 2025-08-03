<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gaji';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'paket_bawaan',
        'paket_jemputan', 
        'potongan_bpjs'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'paket_bawaan' => 'decimal:2',
        'paket_jemputan' => 'decimal:2',
        'potongan_bpjs' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get formatted paket bawaan
     *
     * @return string
     */
    public function getFormattedPaketBawaanAttribute()
    {
        return 'Rp ' . number_format($this->paket_bawaan, 0, ',', '.');
    }

    /**
     * Get formatted paket jemputan
     *
     * @return string
     */
    public function getFormattedPaketJemputanAttribute()
    {
        return 'Rp ' . number_format($this->paket_jemputan, 0, ',', '.');
    }

    /**
     * Get formatted potongan BPJS
     *
     * @return string
     */
    public function getFormattedPotonganBpjsAttribute()
    {
        return 'Rp ' . number_format($this->potongan_bpjs, 0, ',', '.');
    }

    /**
     * Get total gaji (bawaan + jemputan - potongan BPJS)
     *
     * @return float
     */
    public function getTotalGajiAttribute()
    {
        return $this->paket_bawaan + $this->paket_jemputan ;
    }

    /**
     * Get formatted total gaji
     *
     * @return string
     */
    public function getFormattedTotalGajiAttribute()
    {
        return 'Rp ' . number_format($this->total_gaji, 0, ',', '.');
    }

    /**
     * Get total per paket (bawaan + jemputan - potongan BPJS)
     * @deprecated Use getTotalGajiAttribute instead
     *
     * @return float
     */
    public function getTotalPerPaketAttribute()
    {
        return $this->paket_bawaan + $this->paket_jemputan ;
    }

    /**
     * Get formatted total per paket
     * @deprecated Use getFormattedTotalGajiAttribute instead
     *
     * @return string
     */
    public function getFormattedTotalPerPaketAttribute()
    {
        return 'Rp ' . number_format($this->total_per_paket, 0, ',', '.');
    }
}
