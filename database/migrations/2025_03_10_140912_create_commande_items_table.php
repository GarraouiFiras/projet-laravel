<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade'); // Lier à la commande
            $table->string('type_produit'); // 'car' ou 'accessoire'
            $table->foreignId('produit_id'); // ID du produit (car ou accessoire)
            $table->integer('quantite'); // Quantité commandée
            $table->decimal('prix_unitaire', 10, 2); // Prix unitaire au moment de la commande
            $table->string('image')->nullable(); // Image du produit
            $table->timestamps(); // created_at et updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('commande_items');
    }
}