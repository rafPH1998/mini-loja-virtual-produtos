<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('CASCADE');
            $table->string('name')->unique();
            $table->string('image');
            $table->integer('quantity_inventory')->require();
            $table->text('description')->nullable();
            $table->dateTime('date');
            $table->enum('type', [
                'eletronicos', 
                'livros', 
                'jogos', 
                'acessorios', 
                'brinquedos', 
                'roupas', 
                'perfumaria'
            ]);
            $table->enum('quality', ['novo', 'semi_novo', 'bom', 'medio'])->default('bom');
            $table->float('price');
            $table->float('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
