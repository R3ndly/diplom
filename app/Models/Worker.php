<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $primaryKey = 'worker_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['name', 'surname', 'patronymic', 'position_id', 'salary', 'hire_date', 'education_id', 'phone_number', 'email'];

    public $timestamps = false;

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }
}
