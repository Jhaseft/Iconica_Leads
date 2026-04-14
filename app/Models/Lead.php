<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lead extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'nombre_completo',
        'cargo',
        'telefono',
        'correo_electronico',
        'nombre_empresa',
        'sector_industria',
        'ciudad',
        'ip_origen',
        'utm_source',
        'utm_medium',
        'utm_campaign',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Lead $model): void {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
