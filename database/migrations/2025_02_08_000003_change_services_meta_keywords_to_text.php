<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE services MODIFY meta_keywords TEXT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE services MODIFY meta_keywords VARCHAR(255) NULL');
    }
};
