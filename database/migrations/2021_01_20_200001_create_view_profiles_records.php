<?php

use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateViewProfilesRecords extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW view_profiles_records
            AS
            SELECT
                users.id,
                users.created_at AS member_since,
                users.username,
                users.first_name,
                users.last_name,
                languages.title AS language,
                languages.code AS language_code,
                countries.nicename AS country,
                countries.iso AS country_code,
                TIMESTAMPDIFF(YEAR, profiles.dob, CURDATE()) AS age,
                CASE WHEN profiles.gender = '1' THEN 'm'
                    WHEN profiles.gender = '0' THEN 'f'
                    ELSE null
                    END AS gender,
                profiles.bio
            FROM
                users
                LEFT JOIN profiles ON users.id = profiles.user_id
                LEFT JOIN countries ON profiles.nationality = countries.id
                LEFT JOIN languages ON profiles.native_lang = languages.id;
        ");
    }

    public function down()
    {
        // Schema::dropIfExists('view_profiles_records');
    }
}
