<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use Auditable, HasFactory;

    public $table = 'sources';

    public static $searchable = [
        'name',
    ];

    
    protected $fillable = [
        'custom_fields',
        'essential_fields',
        'sales_fields',
        'system_fields',
        'project_id',
        'campaign_id',
        'webhook_secret',
        'is_cp_source',
        'name'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'custom_fields' => 'array',
        'essential_fields'=>'array',
        'sales_fields'  => 'array',
        'system_fields' => 'array',
        'project_id'=>'array'
    ];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
