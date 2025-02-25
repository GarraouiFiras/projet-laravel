<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
  
{
    Schema::create('accessoires', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->text('description')->nullable();
        $table->decimal('prix', 10, 2);
        $table->integer('stock')->default(0); // Quantité disponible en stock
        $table->string('image')->nullable(); // Chemin de l'image
        $table->timestamps(); // created_at et updated_at
    });
}

public function down()
{
    Schema::dropIfExists('accessoires');
}

}
