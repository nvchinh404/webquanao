<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['report_type', 'start_date', 'end_date', 'total_amount', 'details'];
}