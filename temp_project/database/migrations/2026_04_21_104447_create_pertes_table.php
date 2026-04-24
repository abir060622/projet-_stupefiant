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
    Schema::create('pertes', function (Blueprint $table) {
        $table->id();
        $table->string('numero_bon')->unique();
        $table->string('produit');
        $table->integer('quantite');
        $table->string('infirmier');
        $table->string('service');
        $table->text('motif');
        $table->date('date_perte');
        $table->enum('statut', ['normale', 'alerte'])->default('normale');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertes');
    }
};
