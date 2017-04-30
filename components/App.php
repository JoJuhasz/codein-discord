<?php namespace Codein\Discord\Components;

use Cms\Classes\ComponentBase;
use Codein\Discord\Classes\Discord;
use Codein\Discord\Models\Bot;
use Codein\Discord\Models\Guild;

class App extends ComponentBase
{

    public $channels;
    public $members = false;

    protected $discord;

    public function componentDetails()
    {
        return [
            'name'        => 'codein.discord::lang.component.app.name',
            'description' => 'codein.discord::lang.component.app.description'
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
            'view_members' => [
                'title'       => 'codein.discord::lang.view_members',
                'description' => '',
                'type'        => 'checkbox',
                'default'     => ''
            ],
            'allow_send_messages' => [
                'title'       => 'codein.discord::lang.allow_send_messages',
                'description' => 'codein.discord::lang.allow_send_messages_desc',
                'type'        => 'checkbox',
                'default'     => ''
            ],
        ];
    }


    public function onRun()
    {
        $discord = $this->getDiscord();
        $channels   = $discord->getChannels(true);

        if($this->property('view_members')) {
            $members    = $discord->getMembers();
            $this->members = $members;
        }

        $this->channels = $channels;
    }

    public function onSelectChannel()
    {
        $discord = $this->getDiscord();
        $channelId = input('channel');

        $this->page['channel'] = $discord->getChannel($channelId);
        $this->page['messages'] = $discord->getChannelMessages($channelId);

    }

    public function onSendMessage()
    {
        $message = input('message');
        $channelId = input('channel_id');
        $discord = $this->getDiscord();

        $discord->sendMessage($message, $channelId);

        $this->page['channel'] = $discord->getChannel($channelId);
        $this->page['messages'] = $discord->getChannelMessages($channelId);
    }


    protected function getDiscord()
    {
        if(is_null($this->discord)) {
            $guild  = Guild::find($this->property('guild'));
            $bot    = Bot::find($this->property('bot'));

            $this->discord = new Discord($guild, $bot);
        }

        return $this->discord;
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


}
