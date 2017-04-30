<?php

namespace Codein\Discord\Classes;

use Codein\Discord\Models\Bot;
use Codein\Discord\Models\Guild;

class Discord
{
    const API_URL           = "https://discordapp.com/api/";
    const AUTHORIZE_URL     = "https://discordapp.com/api/oauth2/authorize";
    const L_AUTHORIZE_URL   = "discord/login/redirect";
    const TOKEN_URL         = "https://discordapp.com/api/oauth2/token";
    const TOKEN_REVOKE_URL  = "https://discordapp.com/api/oauth2/token/revoke";
    const USER_AGENT        = "DiscordBot (https://github.com/JoJuhasz/codein-discord, 0.1.0)";

    public $guild;
    public $bot;
    public $role;

    public function __construct(Guild $guild = null, Bot $bot = null)
    {
        $this->guild = $guild;
        $this->bot   = $bot;
        if(!is_null($guild)) {
            $this->role  = $this->getEveryoneRole();
        }
    }

    public function getChannels($includeMessages = false)
    {
        $url = self::API_URL . "guilds/".$this->guild->discord_id.'/channels';
        $channelsBody = $this->botRequest($url);

        foreach($channelsBody as $key => $channel) {

            $channelObj = new Channel();

            if(!$channelObj->canAccess($channel, $this->role)) {
                unset($channelsBody[$key]);
                continue;
            }

            if($includeMessages) {
                $channel->messages = $this->getChannelMessages($channel->id);
            }
        }

        return $channelsBody;
    }

    public function getChannel($channelId)
    {
        $url = self::API_URL . "channels/".$channelId;
        $channelBody = $this->botRequest($url);

        return $channelBody;
    }

    public function getChannelMessages($channelId)
    {
        $url = self::API_URL . "channels/".$channelId.'/messages';
        try {
            $messagesBody = $this->botRequest($url);
            $messagesBody = array_reverse($messagesBody);
            return $messagesBody;
        } catch(\GuzzleHttp\Exception\ClientException $e) {
            return [];
        }
    }

    public function getToken($authCode, $redirect = "discord/login")
    {
        $clientId       = $this->bot->client_id;
        $clientSecret   = $this->bot->client_secret;

        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', self::TOKEN_URL, [
                'query' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'code' => $authCode,
                    'redirect_uri' => url($redirect)
                ],
                'headers' => [
                    'User-Agent' => self::USER_AGENT
                ]
            ]);

            $tokenResponse = json_decode($response->getBody()->getContents());
            if ($tokenResponse->access_token) {
                return $tokenResponse->access_token;
            }

        } catch(\Exception $e) {

            return false;

        }
    }

    public function getDiscordUser($token)
    {
        try {

            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', self::API_URL . "users/@me", [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'User-Agent' => self::USER_AGENT
                ]
            ]);

            $userData = json_decode($response->getBody()->getContents());

            return $userData;

        } catch(\Exception $e) {

            return false;

        }
    }

    public function addUserToGuild($token, $userId)
    {
        try {

            $botToken = $this->bot->token;
            $guild = $this->guild->discord_id;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('PUT', self::API_URL . "guilds/{$guild}/members/{$userId}", [
                'headers' => [
                    'Authorization' => 'Bot '.$botToken,
                    'User-Agent' => self::USER_AGENT
                ],
                'json' => [
                    'access_token' => $token
                ]
            ]);

            return $response;

        } catch(\Exception $e) {

            return false;

        }
    }

    public function getMembers()
    {
        $url = self::API_URL . "guilds/".$this->guild->discord_id.'/members?limit=20';
        $membersBody = $this->botRequest($url);

        return $membersBody;
    }

    public function sendMessage($message, $channelId)
    {
        $url = self::API_URL . "channels/".$channelId.'/messages';
        $client = new \GuzzleHttp\Client();

        $data = array(
            'content' => $message
        );

        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bot '.$this->bot->token,
                'User-Agent' => self::USER_AGENT,
                'Content-Type' => 'application/json'
            ],
            'json' => $data
        ]);

        $this->page['messages'] = $this->getChannelMessages($channelId);

    }

    public function getEveryoneRole()
    {
        $guildId = $this->guild->discord_id;
        $url = self::API_URL . "guilds/".$guildId.'/roles';
        $rolesBody = $this->botRequest($url);

        foreach ($rolesBody as $role) {
            if($role->name == "@everyone") {
                return $role;
            }
        }
    }

    public function getAuthorizeUrl($local = false, $scope = "email+identify", $redirectUri = 'discord/login')
    {
        $base = self::AUTHORIZE_URL;
        if($local) {
            $base = url(self::L_AUTHORIZE_URL);
        }
        $url = $base . "?client_id={$this->bot->client_id}&secret={$this->bot->client_secret}&response_type=code&bot={$this->bot->id}&scope=".$scope;
        if(!is_null($redirectUri)) {
            $url .= "&redirect_uri=".url($redirectUri);
        }
        if(!is_null($this->guild)) {
            $url .= "&guild=".$this->guild->id;
        }
        return $url;
    }

    public function botRequest($url)
    {
        $botToken = $this->bot->token;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bot '.$botToken,
                'User-Agent' => self::USER_AGENT
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

}