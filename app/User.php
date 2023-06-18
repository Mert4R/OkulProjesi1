<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function getField($id,$field)
    {
        $c = User::where('id','=',$id)->count();
        if ($c!=0)
        {
            $w = User::where('id','=',$id)->get();
            return $w[0][$field];
        }else
        {
            return "Silinmiş Kullanıcı";
        }
    }
    public function begenilenUrunler()
    {
        return $this->belongsToMany(Kitaplar::class, 'begenilen_urunler', 'user_id', 'urun_id');
    }
    public function sepetUrunler()
    {
        return $this->belongsToMany(Kitaplar::class, 'sepet_urunler', 'user_id', 'urun_id');
    }
}
