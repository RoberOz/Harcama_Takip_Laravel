<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Expenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('expenses', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('categories_id')->unsigned();
          $table->integer('amount');
          $table->string('location');
          $table->timestamps();

          $table->foreign('categories_id')
                ->references('id')
                ->on('categories');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
