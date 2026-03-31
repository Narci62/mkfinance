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
        Schema::table('companies', function (Blueprint $table) {
            $table->string("company_email")->nullable()->after('staff_number');
            $table->string('company_phone_number')->nullable()->after('staff_number');
            $table->string('company_website')->nullable()->after('staff_number');
            $table->string('company_adresse')->nullable()->after('staff_number');
            $table->string('main_rccm')->nullable()->after('staff_number');
            $table->string('main_ifu')->nullable()->after('staff_number');
            $table->string('main_atf')->nullable()->after('staff_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('company_email');
            $table->dropColumn('company_phone_number');
            $table->dropColumn('company_website');
            $table->dropColumn('company_adresse');
            $table->dropColumn('main_rccm');
            $table->dropColumn('main_ifu');
            $table->dropColumn('main_atf');
        });
    }
};
