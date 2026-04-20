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
    Schema::create('mouvements', function (Blueprint $table) {
        $table->id();
        
        // Relation avec le produit 
        $table->foreignId('produit_id')->constrained()->onDelete('cascade');
        
        // Type de mouvement
        $table->enum('type', ['entree', 'sortie', 'destruction', 'retour']);
        
        $table->integer('quantite');
        $table->string('lot_number'); // Crucial pour suivi des lots critiques
        
        // Traçabilité Nominative
        // L'utilisateur qui fait l'action 
        $table->foreignId('user_id')->constrained('users'); 
        
        // Le valideur - peut être NULL au début
        $table->unsignedBigInteger('validator_id')->nullable();
        $table->foreign('validator_id')->references('id')->on('users');
        
        // Détails supplémentaires
        $table->text('observation')->nullable(); 
        $table->boolean('is_conforme')->default(true); // Pour taux de concordance
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements');
    }
};
