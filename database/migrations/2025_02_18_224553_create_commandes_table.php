<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('commandes', function (Blueprint $table) {
        $table->id();
        $table->string('nom_client'); // Nom du client (saisi manuellement)
        $table->decimal('total', 10, 2); // Montant total de la commande
        $table->string('statut')->default('en_attente'); // Statut de la commande
        $table->timestamps(); // created_at et updated_at
    });
}

public function down()
{
    Schema::dropIfExists('commandes');
}
}
