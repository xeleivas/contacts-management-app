<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone_number',
        'profile_picture_url',
        'user_id'
    ];

    /**
     * Get the user that owns the contact.
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
