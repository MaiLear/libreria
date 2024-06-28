<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cost',
        'quantity',
        'author_id',
    ];


    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function lend(){
        return $this->hasMany(Lend::class);
    }
    public function sale(){
        return $this->hasMany(Sale::class);
    }
}
