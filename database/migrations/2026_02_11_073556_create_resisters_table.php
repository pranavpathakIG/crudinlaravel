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
    Schema::create('resisters', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('surname');
        $table->string('mobile', 13 )->unique();
        $table->date('DOB');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('status');
        $table->string('image')->nullable();
        $table->string('adhar')->nullable();
        $table->string('country_code')->default('+91');
 
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resisters');
    }
};
