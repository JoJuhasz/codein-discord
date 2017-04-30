<?php namespace Codein\Discord\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCodeinDiscordBots extends Migration
{
    public function up()
    {
        Schema::create('codein_discord_bots', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('token');
            $table->string('name');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('codein_discord_bots');
    }
}
