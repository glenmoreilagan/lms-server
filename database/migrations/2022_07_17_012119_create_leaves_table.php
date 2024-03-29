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
    Schema::create('tbl_leaves', function (Blueprint $table) {
      $table->id();

      $table->date('start_date')->nullable();
      $table->date('end_date')->nullable();
      $table->string('reason')->nullable();
      $table->boolean('status')->default(false);
      $table->integer('approved_by')->default(0);
      $table->dateTime('approved_at')->nullable();

      $table->unsignedBigInteger('leavetype_id')->nullable();
      $table->unsignedBigInteger('emp_id')->nullable();

      $table->foreign('leavetype_id')->references('id')->on('tbl_leavetypes')->nullOnDelete();
      $table->foreign('emp_id')->references('id')->on('tbl_employees')->nullOnDelete();

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
    Schema::dropIfExists('tbl_leaves');
  }
};
