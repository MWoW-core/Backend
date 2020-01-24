<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\StoredEvent;

class AddUserIdToStoredEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stored_events', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });

        StoredEvent::query()->eachById(function (StoredEvent $storedEvent) {
            $storedEvent->user()->associate($storedEvent->meta_data['user_id'])->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stored_events', function (Blueprint $table) {
            $table->dropForeign('stored_events_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
