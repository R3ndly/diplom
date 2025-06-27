<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_hours extends Model
{
    use HasFactory;

    protected $table = 'working_hours';

    protected $primaryKey = 'working_hours_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['working_hours'];

    public $timestamps = false;

    public function vacancies()
    {
        return $this->hasMany(Vacancies::class);
    }
}
