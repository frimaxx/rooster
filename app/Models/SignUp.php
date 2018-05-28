<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    protected $table = 'sign_ups';

    protected $fillable = [
        'name',
        'email',
        'company_name',
        'token',
        'expire'
    ];

    public function hasExpired()
    {
        return Carbon::now() > Carbon::parse($this->expire);
    }
}
