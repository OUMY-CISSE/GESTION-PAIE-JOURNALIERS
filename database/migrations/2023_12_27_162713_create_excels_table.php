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
        Schema::create('excels', function (Blueprint $table) {
            $table->id();
            $table->string('categorie');
            $table->string('atelier');
            $table->string('quart');
            $table->string('prenom');
            $table->string('nom');
            $table->date('date');
            $table->string('chef_de_quart');
            $table->integer('heure');
            $table->decimal('taux_horaire', 8, 2)->default(0);
            $table->decimal('salaire', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excels');
    }
};
