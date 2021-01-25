<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDifferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('differences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('base_repository_id');
            $table->unsignedBigInteger('repository_id');
            $table->string('status', 20)->default('unknown');
            $table->unsignedInteger('behind_by')->nullable();
            $table->unsignedInteger('ahead_by')->nullable();
            $table->timestamps();

            $table->foreign('base_repository_id')->references('id')->on('repositories');
            $table->foreign('repository_id')->references('id')->on('repositories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('differences');
    }
}
