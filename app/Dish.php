<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    // Table
    protected $table = 'plat';
    // Primary Key
    /*public $primaryKey = 'id';
    // Variable
    public $dishType = 'type_plat';
    // Variable
    public $name = 'name';
    // Variable
    public $description = 'description';
    // Variable
    public $price = 'price';*/
    // Timestamps
    public $timestamps = true;
}
