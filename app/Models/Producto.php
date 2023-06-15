<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory, HasUuids;


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
