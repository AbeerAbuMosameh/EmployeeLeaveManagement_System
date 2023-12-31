<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles_and_permissions_tables', function (Blueprint $table) {
            Schema::table('roles', function (Blueprint $table) {
                $table->enum('role',  ['admin', 'employee'])->default('employee')->after('guard_name');
            });

            Schema::table('permissions', function (Blueprint $table) {
                $table->enum('role', ['admin', 'employee'])->default('employee')->after('guard_name');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->dropColumn('company_id');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->dropColumn('company_id');
        });
    }
};
