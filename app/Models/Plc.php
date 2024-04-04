<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plc extends Model
{
    public $table = 'plc';

    use HasFactory;

    protected $fillable = [
        'name',
        'tag',
        'increment/decrement',
        'project_id',
        'price'
    ];
    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function plotDetails()
    {
        return $this->hasMany(PlotDetail::class, 'plc_values', 'name');
    }

}
