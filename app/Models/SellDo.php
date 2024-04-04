<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellDo extends Model
{
    use  HasFactory;

    public $table = 'selldo';

    // public static $searchable = [
    //     'name',
    // ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',

    ];

    public function leads()
{
    return $this->hasMany(Lead::class);
}
}
