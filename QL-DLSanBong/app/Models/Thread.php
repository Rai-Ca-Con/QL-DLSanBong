<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Thread extends Model
{
    use HasFactory;
    protected $table = 'threads';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'last_send',
        'last_sender_id',
        'readed'
    ];

    protected $casts = [
        'last_send' => 'datetime',
        'readed' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'thread_id', 'id')->orderBy('time_send', 'desc');
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany('time_send');
    }

    public function getMessagesCountAttribute()
    {
        return $this->messages()->count();
    }
}
