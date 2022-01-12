<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $table = 'tasks';

    public $fillable = [
        'key',
        'content',
        'description',
        'email',
        'phone',
        'file',
        'budget_min',
        'budget_max'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
