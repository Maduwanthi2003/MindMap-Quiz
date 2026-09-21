<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('students', 'profile_photo')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('profile_photo')->nullable()->after('email');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('students', 'profile_photo')) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropColumn('profile_photo');
            });
        }
    }
};
