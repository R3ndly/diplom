<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancies extends Model
{
    use HasFactory;

    protected $primaryKey = 'vacancy_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['title', 'description', 'department_id', 'location_id', 'working_hours_id', 'worker_id', 'salary', 'published_at'];

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function working_hours()
    {
        return $this->belongsTo(Working_hours::class, 'working_hours_id');
    }

    public function workers()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }
}
