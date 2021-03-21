<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthoritiesTable extends Migration
{
    public function up()
    {
        Schema::create('authorities', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->string('local_authority_id_code')->nullable();
            $table->string('name');
            $table->string('region_name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('authorities');
    }
}
