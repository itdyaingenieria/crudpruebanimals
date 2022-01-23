<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotAnimalsCorralesModel extends Model
{
    use HasFactory;

    protected $table = 'pivot_animals_corrales';
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'animals_id', 'corrales_id', 'cantidad', 'created_at', 'updated_at', 'deleted_At'
    ];
}
