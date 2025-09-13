<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeIdSupplierNullableInSurveySuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('survey_suppliers', function (Blueprint $table) {
            $table->unsignedInteger('id_supplier')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_suppliers', function (Blueprint $table) {
            $table->unsignedInteger('id_supplier')->nullable(false)->change();
        });
    }
}
