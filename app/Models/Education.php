<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $primaryKey = 'education_id';

    public $incrementing = true;

    protected $keyType = 'tinyint';

    protected $fillable = ['education_name'];

    public $timestamps = false;

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
