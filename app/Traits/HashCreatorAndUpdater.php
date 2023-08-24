<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HashCreatorAndUpdater
{
    protected static function bootHashCreatorAndUpdater(){
        static::creating(function($model){
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function($model){
            $model->updated_by = Auth::id();
        });
    }

}