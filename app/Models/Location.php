<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $primaryKey = 'location_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['location'];

    public $timestamps = false;

    public function vacancies()
    {
        return $this->hasMany(Vacancies::class);
    }
}
