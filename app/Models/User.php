<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'api_token',
        'user_level',
        'uren_min',
        'uren_max',
        'company_id',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level()
    {
        return $this->user_level;
    }

    public function avatar()
    {
        if (!empty($this->avatar)) {
            return '/assets/images/avatars/' . $this->avatar;
        }
        return "/assets/images/user.svg";
    }

    public function canEditUser($user)
    {
        if ($this->level() > 4) {
            return true;
        }
        if ($this->level() > 2 && $user->company_id == $this->company_id) {
            return true;
        }
        $branches_ids_array = Manager::where('user_id', $this->id)->get()->pluck('branch_id')->toArray();

        $employee = Employee::whereIn('branch_id', $branches_ids_array)->where('user_id', $user->id);
        if ($employee->count() > 0) {
            return true;
        }
        $manager = Manager::where('user_id', $user->id)->whereIn('branch_id', $branches_ids_array);
        if ($manager->count() > 0) {
            return true;
        }
        return false;
    }

    public function branches()
    {
        if ($this->user_level > 2) {
            return Branch::where('company_id', $this->company_id)->orderBy('name', 'asc')->get();
        }
        return Manager::select('branches.id', 'branches.name', 'branches.reference', 'branches.city', 'branches.address', 'branches.postal_code')
            ->where('user_id', $this->id)
            ->where('branches.company_id', $this->company_id)
            ->join('branches', 'branches.id', 'managers.branch_id')
            ->orderBy('name', 'asc')->get();
    }

    public function branchesEmployee()
    {
//        if ($this->user_level > 2) {
//            return Branch::orderBy('name', 'asc')->where('company_id', $this->company_id)->get();
//        }
        return Employee::select('branches.id', 'branches.name', 'branches.reference', 'branches.city', 'branches.address', 'branches.postal_code')
            ->where('user_id', $this->id)
            ->join('branches', 'branches.id', 'employees.branch_id')
            ->orderBy('name', 'asc')->get();
    }

    public function company()
    {
        return Company::where('id', $this->company_id)->first();
    }

    public function readableRank() {
        switch($this->user_level) {
            case 5:
                return 'Admin';
                break;
            case 4:
                return 'Eigenaar';
                break;
            case 3:
                return 'Rayon Manager';
                break;
            case 2:
                return 'Manager';
                break;
            default:
                return 'Medewerker';
                break;
        }
    }
}
