<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerlomLead extends Model
{
    use HasFactory;

    public $table = 'cpwalkinleads';

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
        'ref_num',
        'source',
        'sub_source',
        'project_id',
        'sell_do_id',
        'status',
        'referred_by',
        'created_at',
        'updated_at',

    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
