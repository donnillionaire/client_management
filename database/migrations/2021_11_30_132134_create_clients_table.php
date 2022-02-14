<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            // $table->id();
            $table->increments('client_id')->index();
            $table->string('address', 100);
            $table->string('phone', 50);
            $table->string('org_email', 100);
            $table->string('organization', 250);
            $table->integer('category_id')->unsigned();
            $table->string('logo', 100)->default('no_logp.png');
            $table->boolean('client_status')->default(1);
            $table->boolean('sub_dept_exist')->default(0);
            $table->boolean('demo_acc')->default(0);
            $table->boolean('has_sister')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('clients');
    }
}
