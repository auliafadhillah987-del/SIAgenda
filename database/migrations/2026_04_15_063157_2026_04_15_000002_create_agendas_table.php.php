<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
{
    Schema::create('agendas', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        
        // Kolom kategori (menghubungkan ke tabel categories)
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        
        // Kolom status yang tadi error
        $table->string('status')->default('mendatang'); 
        
        $table->datetime('start_date');
        $table->datetime('end_date');
        $table->string('location');
        $table->text('description')->nullable();
        $table->string('attachment')->nullable();
        $table->timestamps();
    });
}
};