<?php
namespace Codein\Discord\Http\Controllers\Discord;

use Codein\Discord\Classes\Discord;
use Codein\Discord\Models\Bot;
use Codein\Discord\Models\Guild;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use October\Rain\Support\Facades\Flash;

class JoinController extends Controller
{
    
    public function join()
    {

        $botId = Session::get('bot_id');
        $guildId = Session::get('guild_id');

        if(!$botId || !$guildId) {
            Flash::error(trans('codein.discord::lang.discord.bot_guild_required'));
            return Redirect::to('/');
        }
        $bot = Bot::find($botId);
        $guild = Guild::find($guildId);
        $discord = new Discord($guild, $bot);
        
        $code = Input::get('code', false);
        if($code !== false) {
            $token = $discord->getToken($code, 'discord/join');
            if($token !== false) {
                $discordUser = $discord->getDiscordUser($token);
                if($discordUser !== false) {
                    $res = $discord->addUserToGuild($token, $discordUser->id);
                    Flash::success(trans('codein.discord::lang.discord.joined_guild'));
                } else {
                    Flash::error(trans('codein.discord::lang.discord.no_user_found'));
                }
            } else {
                Flash::error(trans('codein.discord::lang.discord.no_valid_token'));
            }
        } else {
            Flash::error(trans('codein.discord::lang.discord.no_valid_auth'));
        }
        return Redirect::to('/');
    }
}