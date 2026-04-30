<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar semua kolom bisa diisi
    protected $fillable = [
        'title', 
        'category_id', 
        'user_id',
        'status', 
        'start_date', 
        'end_date', 
        'location', 
        'description', 
    ];
    
    // Opsional: Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}