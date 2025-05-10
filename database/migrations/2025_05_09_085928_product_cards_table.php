<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('product_cards', function (Blueprint $table) {
            $table->id();  
            $table->string('sku')->unique(); 
            $table->string('product_name');
            $table->string('product_group');
            $table->date('expiration_date');
            $table->text('description')->nullable();  
            $table->timestamps();  
        });
    }

    
    public function down(): void
    {
       Schema::dropIfExists('product_cards');
    }
};
