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
    Schema::table('distributions', function (Blueprint $table) {
        $table->string('signature_infirmier')->nullable();
        $table->string('signature_responsable')->nullable();
        $table->enum('validation_statut', ['en_attente', 'une_signature', 'validee', 'rejetee'])->default('en_attente');
    });
}

public function down(): void
{
    Schema::table('distributions', function (Blueprint $table) {
        $table->dropColumn(['signature_infirmier', 'signature_responsable', 'validation_statut']);
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('distributions', function (Blueprint $table) {
            //
        });
    }
};
