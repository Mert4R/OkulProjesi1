<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kitaplar extends Model
{
    protected $guarded = [];
    public function begenenKullanicilar()
    {
        return $this->belongsToMany(User::class, 'begenilen_urunler', 'urun_id', 'user_id');
    }
    public function sepetKullanicilar()
    {
        return $this->belongsToMany(User::class, 'sepet_urunler', 'urun_id', 'user_id');
    }

}

