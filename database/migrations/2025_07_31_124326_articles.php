<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('image');
            $table->longText('content');
            $table->integer('hit')->default(0);
            $table->string('status')->default('0')->comment('0:pasif 1:aktif'); // Assuming you want a status field
            $table->softDeletes();
            $table->string('slug');
            $table->timestamps();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
