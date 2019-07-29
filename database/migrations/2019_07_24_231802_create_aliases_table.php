<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAliasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aliases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source_username', 50)->nullable($value = false);
            $table->unsignedBigInteger('source_domain_id')->nullable($value = false);
            $table->foreign('source_domain_id')->references('id')->on('domains')->onDelete('cascade');
            $table->unsignedBigInteger('destination_user_id')->nullable($value = false);
            $table->foreign('destination_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('aliases');
    }
}
