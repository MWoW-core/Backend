<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Airlock\PersonalAccessToken;
use App\User;

class AddTokenableToPersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->morphs('tokenable');
        });

        PersonalAccessToken::query()->eachById(function (PersonalAccessToken $personalAccessToken) {
            $personalAccessToken->tokenable()->associate(
                User::query()->find($personalAccessToken->user_id)
            );
        });

        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
