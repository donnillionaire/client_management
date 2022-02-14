<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('dept_id')->index();
            $table->string('dept_address', 100)->nullable();
            $table->string('dept_phone', 50)->nullable();
            $table->string('dept_email', 100)->nullable();
            $table->string('dept_name', 250)->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('logo', 100)->nullable();
            $table->boolean('dept_status')->default(1);
            $table->integer('client_id')->unsigned();
            $table->integer('group_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('client_id')->references('client_id')->on('clients');
            $table->foreign('group_id')->references('group_id')->on('departments_groupings');
            $table->foreign('category_id')->references('category_id')->on('clients_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
