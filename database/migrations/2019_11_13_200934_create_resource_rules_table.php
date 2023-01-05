<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->text('content_it');
            $table->text('content_du');
            $table->text('content_fr');
            $table->text('content_sp');
            $table->text('content_pt');
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
        Schema::dropIfExists('resource_rules');
    }
}
