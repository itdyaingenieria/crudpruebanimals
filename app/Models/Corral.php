<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corral extends Model
{
    use HasFactory;
    protected $table = "corrales";
    protected $guarded = [];
    public function animal()
    {
        return $this->hasMany(Animal::class);
    }
}
