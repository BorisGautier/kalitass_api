<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoringForm extends Model
{
    use HasFactory;

    protected $table = 'monitoring_form';

    protected $fillable = ['user_id', 'active_energy', 'basal_energy', 'blood_glucose',
        'blood_oxygen', 'blood_diastolic', 'blood_systolic', 'body_max_index', 'body_temperature',
        'heart_rate', 'height', 'steps', 'weight', 'distance_walking',
        'mindfulness', 'sleep_in_bed', 'sleep_as_bed', 'sleep_awake'];

    protected $hidden = ['created_at', 'updated_at'];
}
