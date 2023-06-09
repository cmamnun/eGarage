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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('image')->nullable();
            $table->integer('fee');
        });

        Schema::create('user_service', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_service', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
        Schema::dropIfExists('user_service');
        Schema::dropIfExists('services');
    }
};
