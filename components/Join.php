<?php namespace Codein\Discord\Components;

use Cms\Classes\ComponentBase;
use Codein\Discord\Classes\Discord;
use Codein\Discord\Models\Bot;
use Codein\Discord\Models\Guild;

class Join extends ComponentBase
{
    protected $discord;
    public $authUrl;
    
    public function componentDetails()
    {
        return [
            'name'        => 'codein.discord::lang.component.join.name',
            'description' => 'codein.discord::lang.component.join.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'guild' => [
                'title'       => 'codein.discord::lang.guild_label',
                'description' => '',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'bot' => [
                'title'       => 'codein.discord::lang.bot_label',
                'description' => '',
                'type'        => 'dropdown',
                'default'     => ''
            ],
        ];
    }

    public function onRun()
    {
        $discord = $this->getDiscord();
        
        $this->authUrl = $discord->getAuthorizeUrl(true, "email+identify", "discord/join");
    }

    /**
     * Bot Dropdown options populator
     * @return array
     */
    public function getBotOptions()
    {
        $bots = Bot::all();

        $options = ['' => trans('codein.discord::lang.select_bot')];
        foreach($bots as $bot) {
            $options[$bot->id] = $bot->name;
        }

        return $options;
    }

    /**
     * Guild Dropdown options populator
     * @return array
     */
    public function getGuildOptions()
    {
        $guilds = Guild::all();

        $options = ['' => trans('codein.discord::lang.select_guild')];
        foreach($guilds as $guild) {
            $options[$guild->id] = $guild->name;
        }

        return $options;
    }


    protected function getDiscord()
    {
        if(is_null($this->discord)) {
            $bot  = Bot::find($this->property('bot'));
            $guild  = Guild::find($this->property('guild'));

            $this->discord = new Discord($guild, $bot);
        }

        return $this->discord;
    }
    
    
    
}
