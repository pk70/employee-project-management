<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskInfo extends Model
{
    use HasFactory;
    protected $table='task_info';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_tasks',
        'location_information',
        'file_path',
        'file_name',
    ];

    public $timestamps=true;

    public function getLocationInformationAttribute($value)
    {
        return unserialize($value);
    }
}
