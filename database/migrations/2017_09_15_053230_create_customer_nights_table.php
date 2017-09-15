<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerNightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_nights', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('code_id');
          $table->string('name');
          $table->string('job_title');
          $table->string('current_branch');
          $table->text('area');
          $table->string('remark');
          $table->integer('status');
          $table->integer('new_customer');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_nights');
    }
}
