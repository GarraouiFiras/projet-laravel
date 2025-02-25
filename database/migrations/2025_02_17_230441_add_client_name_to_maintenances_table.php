<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientNameToMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->string('client_name')->before('car_id'); // Ajouter `client_name` avant `car_id`
        });
    }
    
    public function down()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropColumn('client_name'); // Supprimer la colonne si la migration est annulée
        });
    }}