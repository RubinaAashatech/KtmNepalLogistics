<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement('create view user_role_view as select u.id,u.name,u.email,u.is_active,u.created_at,r.name as role from users u, users_roles ur,roles r where u.id = ur.user_id and ur.role_id=r.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DB::statement('DROP VIEW "user_role_view"');
    }
}
