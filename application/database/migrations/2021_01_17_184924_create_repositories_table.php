<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique()->index();
            $table->string('name');
            $table->string('description', 500);
            $table->string('url', 200);
            $table->string('default_branch', 50);
            $table->unsignedInteger('open_issues_count')->default(0);
            $table->unsignedInteger('watchers_count')->default(0);
            $table->string('owner_id', 39)->index();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repositories');
    }
}
