<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('contact_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('phone', 50);
            $table->string('title', 255);
            $table->integer('user_id')->index();
            $table->integer('client_id')->index()->unsigned();
            $table->string('modules', 250);
            $table->boolean('can_update')->default(1);
            $table->boolean('default_user')->default(0);
            $table->integer('department_id')->nullable()->unsigned();
            $table->integer('sub_dept_id')->nullable()->unsigned();
            $table->integer('group_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('client_id')->references('client_id')->on('clients');
            $table->foreign('group_id')->references('group_id')->on('departments_groupings');
            $table->foreign('sub_dept_id')->references('sub_dept_id')->on('sub_departments');
            $table->foreign('department_id')->references('dept_id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
