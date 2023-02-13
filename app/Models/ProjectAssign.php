<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAssign extends Model
{
    use HasFactory;
    protected $table='project_assign';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_project',
        'user_name',
        'assigned_user_id',
    ];

    public $timestamps=true;
}
