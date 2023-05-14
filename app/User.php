<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use HasApiTokens;

    protected $casts = [
        'created_at' => 'datetime:d/m/Y g:i A',
        'updated_at' => 'datetime:d/m/Y g:i A',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'phone', 'password', 'public_id','status'
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function agent_profile(){
        return $this->hasOne(AgentProfile::class);
    }

    public function employer_profile(){
        return $this->hasOne(EmployerProfile::class);
    }

    // public function country_employer_profile(){
    //     $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
    //     $emp_filter=EmployerProfile::where('country',$user_country)->get();
    //     $user_filter= User::with('emp_filter')->where('status', 1)->whereRoleIs('employer')->get();
    //     return $user_filter;
    // }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }
    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function applicants(){
        return $this->hasMany(Applicant::class);
    }

    public function professional_profile(){
        return $this->hasOne(ProfessionalProfile::class);
    }
    public function retired_personnel(){
        return $this->hasOne(RetiredPersonnel::class);
    }
    public function retired_personnel_language(){
        return $this->hasMany(RetiredPersonnelsLanguage::class);
    }
    public function retired_personnel_experiences(){
        return $this->hasMany(RetiredPersonnelsWorkExperience::class);
    }
    public function retired_personnel_educations(){
        return $this->hasMany(RetiredPersonnelEducation::class);
    }
    public function professional_experiences(){
        return $this->hasMany(ProfessionalExperience::class);
    }
    public function qualifications(){
        return $this->hasMany(Qualification::class);
    }

    public function role(){
        return $this->hasOne(Role::class);
    }

    public function user_profile(){
        return $this->hasOne(UserProfile::class);
    }
    public function part_time_maid(){
        return $this->hasOne(Maid::class);
    }
    public function part_time_employer(){
        return $this->hasOne(PartTimeEmployer::class);
    }
    
}
