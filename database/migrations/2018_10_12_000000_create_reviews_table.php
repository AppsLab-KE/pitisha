<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->morphs('reviewer');
            $table->morphs('reviewable');//class name
            $table->boolean('flagged')->default(false);
            $table->string('title')->nullable();
            $table->text('review')->nullable();
            $table->double('rating')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
