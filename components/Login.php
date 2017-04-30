<?php namespace Codein\Discord\Components;

use Cms\Classes\ComponentBase;
use Codein\Discord\Classes\Discord;
use Codein\Discord\Models\Bot;
use Codein\Discord\Models\Guild;

class Login extends ComponentBase
{

    protected $discord;
    public $authUrl;

    public function componentDetails()
    {
        return [
            'name'        => 'codein.discord::lang.component.login.name',
            'description' => 'codein.discord::lang.component.login.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'bot' => [
                'title'       => 'codein.discord::lang.bot_label',
                'description' => '',
                'type'        => 'dropdown',
                'default'     => ''
            ],
        ];
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

    public function onRun()
    {
        $discord = $this->getDiscord();
        $this->authUrl = $discord->getAuthorizeUrl(true);
    }

    protected function getDiscord()
    {
        if(is_null($this->discord)) {
            $bot  = Bot::find($this->property('bot'));

            $this->discord = new Discord(null, $bot);
        }

        return $this->discord;
    }

}
