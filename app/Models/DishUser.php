<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DishUser extends Pivot
{
    protected $table = 'dish_user';

    protected $fillable = ['user_id', 'dish_id', 'rating'];

}
