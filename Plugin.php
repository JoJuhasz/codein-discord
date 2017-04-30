<?php namespace Codein\Discord;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function register()
    {
        $this->registerConsoleCommand('discord.gateway.run', 'Codein\Discord\Console\Gateway');
    }

    public function registerComponents()
    {
        return [
            'Codein\Discord\Components\App' => 'discordapp',
            'Codein\Discord\Components\Login' => 'discordlogin',
            'Codein\Discord\Components\Join' => 'discordjoin',
        ];
    }

    public function registerSettings()
    {
    }
}
