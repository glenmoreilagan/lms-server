<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tbl_employees', function (Blueprint $table) {
      $table->id();
      $table->string('empcode')->nullable();
      $table->string('empname')->nullable();
      $table->string('address')->nullable();
      $table->string('phone')->nullable();
      $table->string('email')->unique();
      $table->integer('dept_id')->default(0);
      $table->string('image')->nullable();
      $table->boolean('is_inactive')->default(0);
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
    Schema::dropIfExists('tbl_employees');
  }
};
