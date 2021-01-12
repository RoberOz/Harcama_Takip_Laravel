<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

  public function category(){

    return $this->belongsTo(Category::class, 'category_id', 'id');
    //     $this-belongsTo(Model,'foreign_key','local_key');
  }
}
