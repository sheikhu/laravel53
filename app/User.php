<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function searchableAs()
    {
        return 'users';
    }

    public function toSearchableArray()
    {
        $array = collect($this->toArray());

        $foo = collect($this->dates)->each(function ($field) use ($array) {

            $array->offsetSet($field, $this->getAttribute($field)->toIso8601String());
        });

        return $array->toArray();
    }
}
