<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $table = 'tracker';

    public $timestamps = false;
    protected $fillable = ['page', 'ip', 'status', 'visited_at'];

    protected function casts(): array
    {
        return ['visited_at' => 'datetime'];
    }
}
