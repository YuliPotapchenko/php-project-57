<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    use HasFactory;

    protected $table = 'labels';

    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_label', 'label_id', 'task_id');
    }
}
