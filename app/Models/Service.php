<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Service extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'request_type',
        'tracking_code',
        'status',
        'comment',
        'data', 'modified_by'
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
        $user = $this->users;
        if ($user) {
            $firstName = $user->fname ?: '';
            $middleName = $user->middlename ?: '';
            $lastName = $user->lname ?: '';
            return trim("$firstName $middleName $lastName");
        }
        \Log::warning('User relationship not resolved for Service ID: ' . $this->id);
        return 'Unknown User';
    }
    

    protected $dates = ['deleted_at'];
    protected $casts = [
        'data' => 'array',
    ];
    
    
      public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'modified_by', 'id');
    }
}