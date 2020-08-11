<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $table = 'branches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'reference',
        'city',
        'address',
        'postal_code',
        'company_id'
    ];

    public function getEmployees($branch_id) {
        return $this->select('branches.name as branch_name', 'users.name', 'users.username', 'users.id as user_id', 'users.uren_min', 'users.uren_max', 'users.avatar')
            ->where('branches.id', $branch_id)
            ->whereNull('users.deleted_at')
            ->join('employees', 'employees.branch_id', '=', 'branches.id')
            ->join('users', 'employees.user_id', '=', 'users.id');
    }
}
