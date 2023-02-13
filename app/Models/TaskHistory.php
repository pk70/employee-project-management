<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_tasks',
        'task_start',
        'task_end',
        'break_start',
        'break_end',
        'task_details',
        'break',
        'status',
    ];

    public $timestamps=true;
    // public function task(){
    //     return $this->hasMany(Task::class,'id_tasks');
    // }

}
