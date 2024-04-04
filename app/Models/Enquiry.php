<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use  HasFactory;

    public $table = 'enquires';

    // public static $searchable = [
    //     'name',
    // ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'referred_by',
        'city',
        'project_id',
        'created_at',
        'updated_at',

    ];

    public function leads()
{
    return $this->hasMany(Lead::class);
}
}
