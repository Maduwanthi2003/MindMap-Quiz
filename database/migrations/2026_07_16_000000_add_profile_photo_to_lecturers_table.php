<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilePhotoToLecturersTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('lecturers') && !Schema::hasColumn('lecturers', 'profile_photo')) {
            Schema::table('lecturers', function (Blueprint $table) {
                $table->string('profile_photo')->nullable()->after('email');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('lecturers') && Schema::hasColumn('lecturers', 'profile_photo')) {
            Schema::table('lecturers', function (Blueprint $table) {
                $table->dropColumn('profile_photo');
            });
        }
    }
}
