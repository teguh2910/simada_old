<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropFileColumnsFromRfqAprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rfq_aprs', function (Blueprint $table) {
            $table->dropColumn(['drawing_file', 'excel_term_file']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rfq_aprs', function (Blueprint $table) {
            $table->string('drawing_file')->nullable()->after('status');
            $table->string('excel_term_file')->nullable()->after('drawing_file');
        });
    }
}
