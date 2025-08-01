<?php

namespace App\Http\Traits;


use App\Models\Search;

trait SearchTrait

{

    public static function bootSearchTrait()
    {
        static::created(function ($model) {
            $data = [
                'entity_id' => $model->id,
                'entity_type' => strtolower(class_basename($model)),
                'name' => $model->name,
                'slug' => $model->slug,
            ];

            Search::create($data);
        });

        static::updated(function ($model) {
            Search::where('entity_id', $model->id)
                ->where('entity_type', strtolower(class_basename($model)))
                ->updateOrCreate([
                    'entity_id' => $model->id,
                    'entity_type' => strtolower(class_basename($model))
                ],
                [
                    'name' => $model->name,
                    'slug' => $model->slug,
                ]);
        });

        static::deleted(function ($model) {
            Search::where('entity_id', $model->id)
                ->where('entity_type', strtolower(class_basename($model)))
                ->delete();
        });
    }
}
