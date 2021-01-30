<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

class CreateViewSentencesRecords extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW view_sentences_records
            AS
            SELECT
                sentences.id,
                sentences.user_id AS author_id,
                sentences.lang_id,
                sentences.created_at AS publish_date,
                sentences.body,
                languages.title AS lang,
                languages.code AS lang_code,
                users.username AS author_username,
                users.first_name AS author_first_name,
                users.last_name AS author_last_name,
                (SELECT COUNT(*) FROM bookmarks WHERE sentence_id=sentences.id) AS bookmarked,
                (SELECT COUNT(*) FROM likes WHERE sentence_id=sentences.id AND is_like=1) AS upvotes,
                (SELECT COUNT(*) FROM likes WHERE sentence_id=sentences.id AND is_like=0) AS downvotes
            FROM
                sentences
                LEFT JOIN users ON sentences.user_id = users.id
                LEFT JOIN languages ON sentences.lang_id = languages.id;
        ");
    }

    public function down()
    {
        // Schema::dropIfExists('view_sentences_records');
    }
}
