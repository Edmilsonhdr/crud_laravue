<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todos'; // Defina o nome da tabela no banco de dados

    protected $fillable = ['name', 'description']; // Defina as colunas que podem ser preenchidas em massa

}
