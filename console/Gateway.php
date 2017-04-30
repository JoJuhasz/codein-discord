<?php namespace Codein\Discord\Console;

use Codein\Discord\Models\Bot;
use Discord\Discord;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class Gateway extends Command
{

    protected $logging;
    protected $info;

    /**
     * @var string The console command name.
     */
    protected $name = 'discord:gateway:run';

    /**
     * @var string The console command description.
     */
    protected $description = 'Start the Discord Gateway';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $botId          = $this->option('bot');
        $bot            = Bot::find($botId);
        $this->logging  = $this->option('log');
        $this->info     = $this->option('info');

        if(!$bot) {
            $this->error(trans('codein.discord::lang.console.bot_not_found'));
            return;
        }

        $discord = new Discord([
            'token'     => $bot->token,
            'logging'   => $this->logging
        ]);

        if($this->info) {
            $this->info(trans('codein.discord::lang.console.bot_going_online'));
        }

        $discord->on('ready', function ($discord) {
            if($this->info) {
                $this->info(trans('codein.discord::lang.console.bot_online'));
                $discord->on('message', function ($message) {
                    $this->info("\n{$message->author->username} ".trans('codein.discord::lang.console.says').":");
                    $this->comment("{$message->content}");
                });
            }
        });

        $discord->run();

    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['bot', null, InputOption::VALUE_REQUIRED, trans('codein.discord::lang.console.params.bot'), null],
            ['log', null, InputOption::VALUE_NONE, trans('codein.discord::lang.console.params.log')],
            ['info', null, InputOption::VALUE_NONE, trans('codein.discord::lang.console.params.info')],
        ];
    }
}
