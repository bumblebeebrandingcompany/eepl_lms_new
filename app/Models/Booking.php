<?php
// app/Models/Form.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  // Define the table associated with the model
  protected $table = 'booking';

  // Define the fillable fields for mass assignment
  protected $fillable = [
    'name',
    'aadhar_no',
    'pan',
    'phone',
    'secondary_phone',
    'email',
    'secondary_email',
    'payment_mode',
    //   'plc_values', 
    'total_amount',
    'advance_amount',
    'pending_amount',
    'discount_value_sqft_based',
    'discount_amount_sqft_based',
    //  'discount_value_including_plc',
    //   'discount_amount_including_plc',
    'cheque_no',
    'credit/not_credit',
    'plot_id',
    'status_id',
    'remarks',
    'user_type',
    'per_sqft_based_price'
  ];
  public function plot()
  {
      return $this->belongsTo(PlotDetail::class, 'plot_id');
  }

}
