<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('bukus', function (Blueprint $table) {
        $table->string('foto')->nullable()->after('kategori');
        $table->boolean('favorit')->default(false)->after('foto');
    });
}

public function down()
{
    Schema::table('bukus', function (Blueprint $table) {
        $table->dropColumn(['foto', 'favorit']);
    });
}
};
