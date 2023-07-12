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
        Schema::table('bouteilles', function (Blueprint $table) {
            $table->boolean('est_personnalisee')->default(false);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->boolean('existe_plus')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bouteilles', function (Blueprint $table) {
            $table->dropColumn('est_personnalisee');
            $table->dropColumn('user_id');
            $table->dropColumn('existe_plus');
        });
    }
};
