<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $table = 'responses';
    protected $fillable = ['complaint_id','user_id','response_content'];

    public function complaint(){
        return $this->belongsTo(Complaint::class);
    }

    public function user(){
        return $this->belongsTo(User::class);

    }

}
