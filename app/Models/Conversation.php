<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable=['user_id','label','type','last_message_id'];


    public function participants()
    {
        return $this->belongsToMany(User::class,'participants')->withPivot(['joined_at','role']);
    }
    public function messages()
    {
        return $this->hasMany(Message::class,'conversation_id','id')->latest();
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function lastMessage()
    {
        return $this->belongsTo(Message::class,'last_message_id','id')->withDefault();
    }
}
