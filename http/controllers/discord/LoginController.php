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
use RainLab\User\Facades\Auth;

class LoginController extends Controller
{
    public function redirect()
    {
        $clientId = Input::get('client_id', false);
        $secret = Input::get('client_secret', false);
        $redirect = Input::get('redirect_uri', false);
        $bot = Input::get('bot', false);
        $guild = Input::get('guild', false);
        $scope = Input::get('scope', false);

        Session::put('bot_id', $bot);
        Session::put('guild_id', $guild);
        Session::put('redirect', $redirect);
        $bot = Bot::find($bot);
        if($guild) {
            $guild = Guild::find($guild);
        } else {
            $guild = null;
        }

        $discord = new Discord($guild, $bot);


        return redirect($discord->getAuthorizeUrl(false, "email+identify", $redirect));
    }

    public function login()
    {
        $botId = Session::get('bot_id');
        $redirect = Session::get('redirect');
        if(!$botId) {
            Flash::error(trans('codein.discord::lang.discord.an_error_occured'));
            return Redirect::to('/');
        }
        $bot = Bot::find($botId);
        $discord = new Discord(null, $bot);

        $code = Input::get('code', false);
        if($code !== false) {
            $token = $discord->getToken($code);
            if($token !== false) {
                $discordUser = $discord->getDiscordUser($token);
                if($discordUser !== false) {
                    $user = Auth::findUserByLogin($discordUser->email);
                    if($user) {
                        Auth::login($user);
                        Flash::success('You are now logged in');
                    } else {
                        $user = Auth::register([
                            'name' => $discordUser->username,
                            'email' => $discordUser->email,
                            'password' => 'changeme',
                            'password_confirmation' => 'changeme',
                        ], true);
                        Flash::success(trans('codein.discord::lang.discord.account_created'));
                    }
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