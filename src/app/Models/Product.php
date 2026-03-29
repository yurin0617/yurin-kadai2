<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // これがないと「勝手にデータを入れないで！」とエラー（MassAssignment）になります
    protected $fillable = ['name', 'price', 'image', 'description'];
    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
}