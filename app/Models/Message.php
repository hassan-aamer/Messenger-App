<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable=['conversation_id','user_id','body','type'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class)->withDefault(['name'=>__('User')]);
    }
    public function recipients()
    {
        return $this->belongsToMany(User::class,'recipients')->withPivot(['read_at','deleted_at']);
    }
}
