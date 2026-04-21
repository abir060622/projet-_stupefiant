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
    Schema::create('distributions', function (Blueprint $table) {
        $table->id();
        $table->string('numero_bon')->unique();
        $table->string('produit');
        $table->integer('quantite');
        $table->string('service');
        $table->string('medecin');
        $table->string('patient')->nullable();
        $table->date('date_distribution');
        $table->string('responsable')->default('Admin Pharmacie');
        $table->enum('statut', ['validee', 'en_attente', 'rejetee'])->default('en_attente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
