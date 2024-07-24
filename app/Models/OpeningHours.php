<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to'
    ];

    public function getHoursAttribute() 
    {
        return [
            'from_hour' => (new \DateTime($this->from))->format('G'),
            'to_hour' => (new \DateTime($this->to))->format('G'),
        ];
    }
}
