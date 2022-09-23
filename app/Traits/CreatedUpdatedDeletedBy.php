<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait CreatedUpdatedDeletedBy
{
    /**
     * @return void
     */
    public static function bootCreatedUpdatedDeletedBy(): void
    {
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'created_by') && !$model->isDirty('created_by')) {
                $model->created_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            }
        });

        // updating deleted_by and updated_by when model is deleted
        static::softDeleted(function ($model) {
            if (!$model->isDirty('deleted_by')) {
                $model->deleted_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            }
            $model->save();
        });
    }
}
