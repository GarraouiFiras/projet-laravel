<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade'); // Lier à la commande
            $table->foreignId('accessoire_id')->constrained()->onDelete('cascade'); // Lier à l'accessoire
            $table->integer('quantite'); // Quantité commandée
            $table->decimal('prix_unitaire', 10, 2); // Prix unitaire au moment de la commande
            $table->timestamps(); // created_at et updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
