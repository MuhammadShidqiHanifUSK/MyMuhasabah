<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Drop semua kolom lama sekaligus
        Schema::table('trackers', function (Blueprint $table) {
            $table->dropColumn(['shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya', 'tilawah']);
        });

        // Step 2: Tambah kolom baru
        Schema::table('trackers', function (Blueprint $table) {
            $table->string('shubuh')->nullable()->after('tanggal');
            $table->string('dzuhur')->nullable()->after('shubuh');
            $table->string('ashar')->nullable()->after('dzuhur');
            $table->string('maghrib')->nullable()->after('ashar');
            $table->string('isya')->nullable()->after('maghrib');
            $table->unsignedInteger('tilawah')->default(0)->after('witir');
        });
    }

    public function down(): void
    {
        Schema::table('trackers', function (Blueprint $table) {
            $table->dropColumn(['shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya', 'tilawah']);
        });

        Schema::table('trackers', function (Blueprint $table) {
            $table->boolean('shubuh')->default(false);
            $table->boolean('dzuhur')->default(false);
            $table->boolean('ashar')->default(false);
            $table->boolean('maghrib')->default(false);
            $table->boolean('isya')->default(false);
            $table->boolean('tilawah')->default(false);
        });
    }
};