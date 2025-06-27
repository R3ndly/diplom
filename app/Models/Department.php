<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'department_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['department'];

    public $timestamps = false;

    public function vacancies()
    {
        return $this->hasMany(Vacancies::class);
    }
}
