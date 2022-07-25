<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static addGlobalScope(\Closure $param)
 * @method static creating(\Closure $param)
 */
trait FilterByUser {

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model) {
           $model->userId = auth()->id();
        });

        self::addGlobalScope(function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

}
