<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, Auditable, HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['is_superadmin', 'is_client', 'is_agency', 'is_channel_partner', 'is_channel_partner_manager'];
    
    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    public static $searchable = [
        'name',
        'contact_number_1',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const USER_TYPE_RADIO = [
        'Superadmin' => 'Superadmin',
        'Admin' => 'Admin',
        'Client'     => 'Client',
        'Agency'     => 'Agency',
        'ChannelPartner' => 'Channel Partner',
        'ChannelPartnerManager' => 'Channel Partner Manager',
        'EEPLMgmt' => 'EEPL Mgmt',
        'PresalesHead' => 'Presales Head',
        'Presales' => 'Pre Sales',
        'Sales' => 'Sales',
        'CRMTeam' => 'CRM Team',
        'CRMHead' => 'CRM Head',
        'LegalTeam' => 'Legal Team',
        'BankingTeam' => 'Banking Team',
        'Customer' => 'Customer',
        'SiteExecutive' => 'Site Executive',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sources' => 'array',
        'project_assigned' => 'array'
    ];

    protected $fillable = [
        'ref_num',
        'name',
        'representative_name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'user_type',
        'sources',
        'project_assigned',
        'client_assigned',
        'address',
        'contact_number_1',
        'contact_number_2',
        'website',
        'client_id',
        'agency_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function createdByProjects()
    {
        return $this->hasMany(Project::class, 'created_by_id', 'id');
    }

    public function clientProjects()
    {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    /**
     * is user super admin?
     *
     * @return boolean
     */
    public function getIsSuperadminAttribute()
    {
        return $this->user_type == 'Superadmin';
    }

    /**
     * is user client?
     *
     * @return boolean
     */
    public function getIsClientAttribute()
    {
        return $this->user_type == 'Client';
    }

    /**
     * is user agency?
     *
     * @return boolean
     */
    public function getIsAgencyAttribute()
    {
        return $this->user_type == 'Agency';
    }

    /**
     * is user channel partner?
     *
     * @return boolean
     */
    public function getIsChannelPartnerAttribute()
    {
        return $this->user_type == 'ChannelPartner';
    }

    /**
     * is user channel partner manager?
     *
     * @return boolean
     */
    public function getIsChannelPartnerManagerAttribute()
    {
        return $this->user_type == 'ChannelPartnerManager';
    }

    /**
     * is user admin?
     *
     * @return boolean
     */
    public function getIsAdminAttribute()
    {
        return $this->user_type == 'Admin';
    }

    /**
     * check user permission
     *
     * @return boolean
     */
    public function checkPermission($permission=null){

        if(empty($permission)) return false;

        if(in_array($this->user_type, ['Superadmin'])){
            return in_array($permission, ['number_and_email_masking']) ? false : true;
        } else if(in_array($this->user_type, ['Admin'])) {
            return in_array($permission, ['document_view', 'document_send', 'document_create', 'document_edit', 'user_view', 'user_create', 'user_edit', 'agency_view', 'agency_create', 'agency_edit', 'project_view', 'project_create', 'campaign_view', 'campaign_create', 'source_view', 'source_create', 'calendar', 'profile', 'lead_create', 'lead_edit', 'lead_view', 'lead_activity', 'lead_profile', 'lead_document', 'lead_webhook_response']);
        } else if(in_array($this->user_type, ['EEPLMgmt'])) {
            return in_array($permission, ['document_view', 'document_send', 'document_create', 'document_edit', 'user_view', 'user_create', 'agency_view', 'project_view', 'campaign_view', 'source_view', 'source_create', 'calendar', 'profile', 'lead_create', 'lead_edit', 'lead_view', 'lead_activity', 'lead_profile', 'lead_document']);
        } else if(in_array($this->user_type, ['PresalesHead'])) {
            return in_array($permission, ['document_view', 'document_send', 'project_view', 'user_view', 'calendar', 'profile', 'lead_create', 'lead_view', 'lead_activity', 'lead_profile', 'lead_document', 'number_and_email_masking']);
        } else if(in_array($this->user_type, ['Presales'])) {
            return in_array($permission, ['document_view', 'document_send', 'project_view', 'calendar', 'profile', 'lead_create',  'lead_view', 'lead_activity', 'lead_profile', 'lead_document', 'number_and_email_masking']);
        } else if(in_array($this->user_type, ['Sales'])) {
            return in_array($permission, ['document_view', 'document_send', 'project_view', 'profile', 'lead_create', 'lead_view', 'lead_profile', 'lead_document', 'number_and_email_masking']);
        } else if(in_array($this->user_type, ['CRMTeam'])) {
            return in_array($permission, ['document_view', 'document_send', 'project_view', 'profile', 'lead_view', 'lead_profile', 'lead_document', 'number_and_email_masking']);
        } else if(in_array($this->user_type, ['CRMHead'])) {
            return in_array($permission, ['document_view', 'document_send', 'project_view', 'profile', 'lead_create', 'lead_view', 'lead_activity', 'lead_profile', 'lead_document', 'number_and_email_masking']);
        } else if(in_array($this->user_type, ['LegalTeam'])) {
            return in_array($permission, ['project_view', 'profile']);
        }  else if(in_array($this->user_type, ['BankingTeam'])) {
            return in_array($permission, ['project_view', 'profile']);
        }  else if(in_array($this->user_type, ['Customer'])) {
            return in_array($permission, ['profile']);
        }  else if(in_array($this->user_type, ['Client'])) {
            return in_array($permission, ['profile']);
        }  else if(in_array($this->user_type, ['Agency'])) {
            return in_array($permission, ['profile']);
        }  else if(in_array($this->user_type, ['ChannelPartner'])) {
            return in_array($permission, ['project_view', 'profile', 'lead_create', 'lead_view', 'lead_profile', 'lead_view_own_only']);
        }  else if(in_array($this->user_type, ['ChannelPartnerManager'])) {
            return in_array($permission, ['document_view', 'document_send', 'user_view', 'cp_only_view', 'project_view', 'profile', 'lead_create', 'lead_view', 'lead_activity', 'lead_profile', 'number_and_email_masking']);
        } else if(in_array($this->user_type, ['SiteExecutive'])) {
            return in_array($permission, ['eoi_view', 'eoi_create', 'profile', 'lead_create']);
        }

        return false;
    }
}
