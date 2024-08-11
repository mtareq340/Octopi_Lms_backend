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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->date('start_date')->default(DB::raw('CURRENT_TIMESTAMP')); 
            $table->date('end_date')->nullable(); 
            $table->unsignedInteger('active')->default(0); 
            $table->timestamp('updated_at')->useCurrent();  
            $table->timestamp('created_at')->useCurrent(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_years');
    }
};
