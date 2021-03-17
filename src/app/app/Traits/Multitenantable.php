<?php

namespace App\Traits;


use App\User;
use Illuminate\Database\Eloquent\Builder;

trait Multitenantable
{


    protected static function bootMultitenantable()
    {
        if (auth()->check()) {
            static::creating(function ($model) {

                try {
                    $table = $model->getTable();
                    if ($table == 'users') {
                        $model->parent_id = auth()->user()->id;
                        $model->agent_id = auth()->user()->agent_id;
                    } else {
                        $model->user_id = auth()->user()->id;
                        $model->parent = auth()->user()->parent_id;
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            });

            static::created(function ($model) {
                try {
                    $table = $model->getTable();
                    if ($table == 'users') {
                        switch ($model->level) {
                            case 0:
                                $model->roles()->sync([1]);
                                break;
                            case 1:
                                $model->roles()->sync([2]);
                                break;
                            case 2:
                                $model->roles()->sync([3]);
                                break;
                        }
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            });



            static::addGlobalScope('ref', function (Builder $builder) {

                try {
                    $table = ($builder->getModels()[0])->table;
                    $level = auth()->user()->level;
                    switch ($level) {
                        case 1:
                            if ($table == 'users') {
                                $builder->where('agent_id', auth()->id())
                                    ->orWhere('parent_id', auth()->id())
                                    ->orWhere('id', auth()->id());
                            } else {
                                $builder->where('parent', auth()->id())
                                    ->orWhere('user_id', auth()->id())
                                    ->orWhere('id', auth()->id());
                            }

                            break;
                        case 2:
                            if ($table == 'users') {
                                $builder->where('id', auth()->id());
                            } else {
                                $builder->where('user_id', auth()->id())
                                    ->orWhere('id', auth()->id());
                            }
                            break;
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            });
        }
    }
}
