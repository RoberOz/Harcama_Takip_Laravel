<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'category_id', 'id');
        //     $this-belongsTo(Model,'foreign_key','owner_key');
    }
}
