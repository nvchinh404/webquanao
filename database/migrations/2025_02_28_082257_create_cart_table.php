<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTableMigration extends Migration
{
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            // Thêm ràng buộc duy nhất cho cặp user_id và product_id
            $table->unique(['user_id', 'product_id'], 'cart_user_product_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart');
    }
}