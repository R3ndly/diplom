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

    protected $fillable = ['title', 'description', 'department', 'location', 'type', 'salary', 'published_at', 'contact_email', 'contact_phone'];

    public $timestamps = false;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getFormattedTime(): string
    {
        return $this->published_at->format('d.m.Y');
    }
}
