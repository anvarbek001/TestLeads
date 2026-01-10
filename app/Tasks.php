<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'lead_id',
        'title',
        'due_at',
        'is_done',
    ];

    protected $casts = [
        'due_at' => 'datetime',
        'is_done' => 'boolen'
    ];

    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }
}
