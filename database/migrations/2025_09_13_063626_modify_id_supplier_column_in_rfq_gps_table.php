<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyIdSupplierColumnInRfqGpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rfq_gps', function (Blueprint $table) {
            // Change column type to text for JSON storage
            $table->text('id_supplier')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rfq_gps', function (Blueprint $table) {
            // Revert column type back to integer
            $table->integer('id_supplier')->unsigned()->nullable()->change();
        });
    }
}
