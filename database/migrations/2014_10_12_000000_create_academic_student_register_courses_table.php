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
        Schema::create('academic_student_register_courses', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedInteger('student_id'); 
            $table->unsignedInteger('course_id'); 
            $table->unsignedInteger('level_id'); 
            $table->unsignedInteger('division_id'); 
            $table->unsignedInteger('academic_year_id'); 
            $table->unsignedInteger('academic_term_id'); 
            $table->float('mid_degree')->nullable(); 
            $table->float('work_year_degree')->nullable(); 
            $table->float('amly_degree')->nullable(); 
            $table->float('final_degree')->nullable(); 
            $table->float('total_degree')->nullable(); 
            $table->timestamps(); 
    
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('academic_term_id')->references('id')->on('academic_terms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
