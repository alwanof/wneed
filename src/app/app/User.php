<?php

namespace App;

use App\Traits\Multitenantable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silvanite\Brandenburg\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use Multitenantable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'agent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = ['settings'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function agent()
    {

        return $this->belongsTo(User::class, 'agent_id');
    }
    public function parent()
    {

        return $this->belongsTo(User::class, 'parent_id');
    }

    public function userCan($model)
    {
        if ($model->id == $this->id || $model->parent_id == $this->id || $model->user_id == $this->id) {
            return true;
        }

        if ($this->level == 0) {
            return true;
        }
        /*if ($this->level == 1) {
            if ($model->agent_id == $this->id) {
                return true;
            }
        }*/



        return false;
    }
    public function getSettingsAttribute()
    {

        $settings = Setting::all();
        $result = [];

        foreach ($settings as $setting) {

            $result[$setting->key] = $setting->value;

            $parentConfig = Preference::withoutGlobalScope('ref')->where([
                'key' => $setting->key,
                'parent' => $this->agent_id
            ])->get();
            if ($parentConfig->count() > 0) {

                $result[$parentConfig->first()->key] = $parentConfig->first()->value;
            }

            $userConfig = Preference::withoutGlobalScope('ref')->where([
                'key' => $setting->key,
                'user_id' => $this->id
            ])->get();


            if ($userConfig->count() > 0) {

                $result[$userConfig->first()->key] = $userConfig->first()->value;
            }
        }

        return $result;
    }
}
