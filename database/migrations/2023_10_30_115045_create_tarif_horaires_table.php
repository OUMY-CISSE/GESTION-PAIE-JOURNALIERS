<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarif_horaires', function (Blueprint $table) {
            $table->id();
            $table->string('categorie');
            $table->decimal('taux_horaire', 8, 2)->default(0);
            $table->timestamps();
        });

        $tarif_horaires = [
            ['categorie' => '1', 'taux_horaire' => 312.5],
            ['categorie' => '2', 'taux_horaire' => 375],
            ['categorie' => '3', 'taux_horaire' => 437.5],
            ['categorie' => '4', 'taux_horaire' => 500],
            ['categorie' => '5', 'taux_horaire' => 612.5],
            ['categorie' => '6', 'taux_horaire' => 687.5],
            ['categorie' => '7', 'taux_horaire' => 750],
            ['categorie' => '8', 'taux_horaire' => 625],
        ];

        foreach ($tarif_horaires as $tarif_horaire) {
            DB::table('tarif_horaires')->insert([
                'categorie' => $tarif_horaire['categorie'],
                'taux_horaire' => $tarif_horaire['taux_horaire'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_horaires');
    }
};
