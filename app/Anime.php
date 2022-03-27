<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Anime  extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'capa'];

    public function getCapaUrlAttribute()
    {
        if ($this->capa) {
            return Storage::url($this->capa);
        }

        return Storage::url('anime/sem-imagem.png');
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
