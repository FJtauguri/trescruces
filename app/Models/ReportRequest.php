<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportRequest extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'fullname', 'email', 'contact_num','report_photo','issue','status'
    ];
}
