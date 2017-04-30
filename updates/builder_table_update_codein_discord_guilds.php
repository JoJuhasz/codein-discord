<?php namespace Codein\Discord\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCodeinDiscordGuilds extends Migration
{
    public function up()
    {
        Schema::table('codein_discord_guilds', function($table)
        {
            $table->increments('id')->change();
        });
    }
    
    public function down()
    {
        Schema::table('codein_discord_guilds', function($table)
        {
            $table->integer('id')->change();
        });
    }
}
