<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawanPangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawan_pangans', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('subdistrict');
            $table->double('rasio_lahan', $precision = 15, $scale = 13)->nullable();
            $table->double('rasio_sarana', $precision = 15, $scale = 13)->nullable();
            $table->double('rasio_pddk_tidak_sejahtera', $precision = 15, $scale = 13)->nullable();
            $table->double('akses_jalan', $precision = 15, $scale = 13)->nullable();
            $table->double('rasio_tanpa_air_bersih', $precision = 15, $scale = 13)->nullable();
            $table->double('rasio_pddk_per_tenkes_per_density', $precision = 15, $scale = 13)->nullable();
            $table->enum('p_lahan', [1, 2, 3, 4, 5, 6])->nullable();
            $table->enum('p_sarana', [1, 2, 3, 4, 5, 6])->nullable();
            $table->enum('p_pddk_tidak_sejahtera', [1, 2, 3, 4, 5, 6])->nullable();
            $table->enum('p_jalan', [1, 2, 3, 4, 5, 6])->nullable();
            $table->enum('p_tanpa_air_bersih', [1, 2, 3, 4, 5, 6])->nullable();
            $table->enum('p_pddk_per_tenkes_per_density', [1, 2, 3, 4, 5, 6])->nullable();
            $table->double('indeks', $precision = 15, $scale = 13)->nullable();
            $table->integer('prio_komp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rawan_pangans');
    }
}
