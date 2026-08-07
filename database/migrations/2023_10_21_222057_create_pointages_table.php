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
        Schema::create('pointages', function (Blueprint $table) {
            $table->id();
            $table->string('quart');
            $table->date('date');
            $table->string('chef_de_quart');
            $table->integer('heure');
            $table->string('categorie');
            $table->decimal('taux_horaire', 8, 2)->default(0);
            $table->decimal('salaire', 10, 2)->nullable();
            $table->string('source')->nullable();
            $table->string('source_payement')->nullable();
            $table->timestamps();

            $table->foreignId('journalier_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('atelier_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                    
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pointages');
    }
};
