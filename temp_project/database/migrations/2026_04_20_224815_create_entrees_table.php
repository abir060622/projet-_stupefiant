<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrees', function (Blueprint $table) {
            $table->id();
            $table->string('numero_bon')->unique();
            $table->string('produit');
            $table->integer('quantite');
            $table->string('fournisseur');
            $table->date('date_entree');
            $table->string('responsable')->default('Admin Pharmacie');
            $table->enum('statut', ['validee', 'en_attente', 'rejetee'])->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrees');
    }
};