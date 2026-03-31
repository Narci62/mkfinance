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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('sector_id')->constrained('sectors')->default(1); // Clé étrangère vers la table sectors
            $table->string('other_sector')->nullable();
            $table->string('staff_number')->nullable();
            $table->string('main_logo')->nullable();
            $table->string('main_gallery')->nullable();
            $table->string('yearly_income')->nullable();
            $table->string('website')->nullable();
            $table->string('socials_links')->nullable();
            $table->text('overview_description');
            $table->foreignId('created_by')->constrained('users');
            $table->integer('status')->default(0)->comment('0 => config, 1 => submitted, 2 => waiting, 3 => published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
