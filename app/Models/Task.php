<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_project',
        'task_name',
        'created_by',
    ];

    public $timestamps=true;

    public function taskHistory(){
        return $this->hasMany(TaskHistory::class,'id_tasks');
    }
    public function taskinfo(){
        return $this->hasMany(TaskInfo::class,'id_tasks');
    }
}
