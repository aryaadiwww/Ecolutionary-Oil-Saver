<?php

// app/Models/PointRedemption.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointRedemption extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'reward_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}