<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'sender_id',
        'receiver_id',
        'time_send',
        'content',
        'readed',
        'time_read',
        'thread_id'
    ];
    protected $casts = [
        'time_send' => 'datetime',
        'time_read' => 'datetime',
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

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'message_id', 'id');
    }
}
