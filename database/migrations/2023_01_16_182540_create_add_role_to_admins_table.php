<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddRoleToAdminsTable extends Migration
{
    private $table = 'admins';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->table) and !Schema::hasColumn($this->table, 'role')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->string('role')->nullable();
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
        if (Schema::hasTable($this->table) and Schema::hasColumn($this->table, 'role')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
}
