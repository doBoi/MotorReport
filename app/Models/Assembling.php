<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assembling extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'motor_id',
        'sernum',
        'tgl',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'motor_id' => 'integer',
        'tgl' => 'date',
        'slug' => 'string',
        'spk' => 'string',
        'keterangan' => 'string'
    ];

    public function motor(): BelongsTo
    {
        return $this->belongsTo(Motor::class);
    }
}
