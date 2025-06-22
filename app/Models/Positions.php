<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $primaryKey = 'position_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['position_name'];

    public $timestamps = false;

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
