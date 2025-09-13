<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('pic')->nullable()->after('name');
            $table->string('no_hp')->nullable()->after('pic');
            $table->string('email')->nullable()->after('no_hp');
            $table->string('presdir')->nullable()->after('email');
            $table->text('alamat')->nullable()->after('presdir');
            $table->string('no_telp')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn(['pic', 'no_hp', 'email', 'presdir', 'alamat', 'no_telp']);
        });
    }
}
