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
        Schema::create('academic_terms', function (Blueprint $table) {
            $table->id(); 
            $table->string('name', 100);
            $table->unsignedInteger('academic_year_id'); 
            $table->date('start_date')->nullable(); 
            $table->date('end_date')->nullable(); 
            $table->unsignedInteger('active')->default(0); 
            $table->timestamps();
        
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_terms');
    }
};
