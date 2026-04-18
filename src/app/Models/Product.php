<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // これがないと「勝手にデータを入れないで！」とエラー（MassAssignment）になります
    protected $fillable = ['user_id','name', 'price', 'image', 'description'];
    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }

    public function user()
    {
        // 「私は一人のユーザーに所属しています」という宣言
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}