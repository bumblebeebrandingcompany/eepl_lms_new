<?php
// app/Models/Form.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    // Define the table associated with the model
    protected $table = 'forms';

    // Define the fillable fields for mass assignment
    protected $fillable = ['title', 'description', 'fields','project_id'];

    /**
     * Get the submissions for the form.
     */
    // public function submissions()
    // {
    //     // Assuming you have a "submissions" table with a foreign key "form_id"
    //     return $this->hasMany(Submission::class);
    // }
}
