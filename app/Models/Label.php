<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany('App\Models\Task', 'status_id');
    }
}
