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
        Schema::create('ateliers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');  
            $table->timestamps();
            
        });

        $ateliers = ['Entretien', 'Production', 'Transfert', 'Sécurité', 'Livraison', 'Prestataire', 'Chauffeur', 'Maintenance'];

        foreach ($ateliers as $nomAtelier) {
            DB::table('ateliers')->insert([
                'nom' => $nomAtelier,
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
        Schema::dropIfExists('ateliers');
    }
};
