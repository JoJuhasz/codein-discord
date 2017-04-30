<?php namespace Codein\Discord\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCodeinDiscordGuilds extends Migration
{
    public function up()
    {
        Schema::create('codein_discord_guilds', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->string('discord_id');
            $table->string('name');
            $table->text('description');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('codein_discord_guilds');
    }
}
