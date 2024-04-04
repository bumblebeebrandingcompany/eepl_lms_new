<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PlotDetail extends Model
{
    use HasFactory;

    use HasFactory;
    public $table = 'plot_details';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = ['plot_no','plot_type','dimension_length','dimension_breadth','total_sqfts','price_id/persqfts','overall_sqft_price','plc_values','project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function plc()
    {
        return $this->belongsTo(Plc::class, 'plc_values', 'name');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'plot_id','id');
    }
}
