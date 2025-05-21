<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::table('maintenances', function (Blueprint $table) {  // Notez le 's' ajouté
        $table->foreignId('user_id')->constrained()->after('id');
        $table->string('appointment_type')->after('client_name');
        $table->dropColumn('client_name');
    });
}

public function down()
{
    Schema::table('maintenances', function (Blueprint $table) {  // Notez le 's' ajouté
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
        $table->dropColumn('appointment_type');
        $table->string('client_name')->after('id');
    });
}
}
