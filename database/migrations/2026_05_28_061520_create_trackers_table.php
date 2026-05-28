<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');

            // Sholat Wajib
            $table->boolean('shubuh')->default(false);
            $table->boolean('dzuhur')->default(false);
            $table->boolean('ashar')->default(false);
            $table->boolean('maghrib')->default(false);
            $table->boolean('isya')->default(false);

            // Sholat Sunnah
            $table->boolean('sunnah_qabliyah_shubuh')->default(false);
            $table->boolean('sunnah_qabliyah_dzuhur')->default(false);
            $table->boolean('sunnah_badiyah_dzuhur')->default(false);
            $table->boolean('sunnah_qabliyah_ashar')->default(false);
            $table->boolean('sunnah_qabliyah_maghrib')->default(false);
            $table->boolean('sunnah_badiyah_maghrib')->default(false);
            $table->boolean('sunnah_qabliyah_isya')->default(false);
            $table->boolean('sunnah_badiyah_isya')->default(false);
            $table->boolean('tahajud')->default(false);
            $table->boolean('dhuha')->default(false);
            $table->boolean('witir')->default(false);

            // Amalan Kebaikan Lainnya
            $table->boolean('tilawah')->default(false);
            $table->boolean('dzikir_pagi')->default(false);
            $table->boolean('dzikir_petang')->default(false);
            $table->boolean('puasa_sunnah')->default(false);
            $table->boolean('sedekah')->default(false);
            $table->boolean('membantu_orang')->default(false);
            $table->boolean('silaturahmi')->default(false);

            // Amal Keburukan
            $table->boolean('berkata_kotor')->default(false);
            $table->boolean('berbohong')->default(false);
            $table->boolean('ghibah')->default(false);
            $table->boolean('berkata_kasar')->default(false);
            $table->boolean('merokok')->default(false);
            $table->boolean('begadang_siasia')->default(false);
            $table->boolean('scrolling_berlebihan')->default(false);
            $table->boolean('marah_berlebihan')->default(false);
            $table->boolean('iri_dengki')->default(false);
            $table->boolean('sombong')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trackers');
    }
};
