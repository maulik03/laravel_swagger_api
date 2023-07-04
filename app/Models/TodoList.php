<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $table= 'todo_list';

    protected $fillable = [
        'name',
        'description',
        'is_priority',
        'is_done',
    ];
}
