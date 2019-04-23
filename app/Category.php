<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function items()
    {return $this->hasmany('App\Item');
    }

    public static function listOfOptions()
    {
        $list = self::all()->pluck('name', 'id');
        return $list;
    }


}

