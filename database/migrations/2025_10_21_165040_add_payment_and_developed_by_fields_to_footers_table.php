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
        Schema::table('footers', function (Blueprint $table) {
            $table->string('payment_images')->nullable()->after('footer_color');
            $table->string('developed_by_text')->nullable()->after('payment_images');
            $table->string('developed_by_link')->nullable()->after('developed_by_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('footers', function (Blueprint $table) {
            $table->dropColumn(['payment_images', 'developed_by_text', 'developed_by_link']);
        });
    }
};
