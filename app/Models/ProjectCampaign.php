<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCampaign extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'project_campaigns';

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'webhook_secret',
        'outgoing_webhook',
        'outgoing_apis',
        'campaign_name',
        'start_date',
        'end_date',
        'project_id',
        'agency_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        
        'project_id'=>'array'
    ];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function campaignLeads()
    {
        return $this->hasMany(Lead::class, 'campaign_id', 'id');
    }

    public function campaignSources()
    {
        return $this->hasMany(ProjectSource::class, 'campaign_id', 'id');
    }
    
    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

   
    public function projects()
    {
        return $this->belongsToMany(Project::class,'project_id');
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }
}
