<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price
 extends Model
{
    use HasFactory;
    protected $appends = ['is_superadmin', 'is_client', 'is_agency', 'is_admissionteam', 'is_frontoffice',];
    public $table = 'prices';
    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];
    protected $fillable = ['user_type','price_per_sqft','project_id'];
    
}
