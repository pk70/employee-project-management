<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'created_by',
        'user_response',
    ];

    public $timestamps=true;

    public function projectAssign(){
        return $this->hasMany(ProjectAssign::class,'id_project');
    }
}
