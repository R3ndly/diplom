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

    protected $fillable = ['name', 'surname', 'patronymic', 'position', 'salary', 'hire_date', 'education', 'phone_number', 'email'];

    public $timestamps = false;
}
