<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddStatusToAdminsTable extends Migration
{
    private $table = 'admins';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->table) and !Schema::hasColumn($this->table, 'status')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->string('status')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable($this->table) and Schema::hasColumn($this->table, 'status')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
}
