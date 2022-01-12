<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskChat extends Model
{
    use HasFactory;

    public $table = 'task_chats';

    public $fillable = [
        'task_id',
        'from_id',
        'to_id',
        'message',
        'is_read'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-M-d g:i a',
    ];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id')->select(['id', 'name']);
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_id')->select(['id', 'name']);
    }
}
