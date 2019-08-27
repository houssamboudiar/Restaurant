<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommandPlat extends Model
{
    protected $table = 'commandplat';
    //
    private $id;
    private $id_plat;
    private $orderStatus;
    private $quantity;
    private $price;
    public $timestamps = true;
}
