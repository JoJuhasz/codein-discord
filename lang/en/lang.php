<?php return [
    'plugin' => [
        'name' => 'Discord',
        'description' => 'Discord API intégration',
    ],
    'component' => [
        'app' => [
            'name' => 'Discord App',
            'description' => 'Display preview off your Discord guild'
        ],
        'login' => [
            'name' => 'Login with Discord Button',
            'description' => 'Display a "Login with Discord" button'
        ],
        'join' => [
            'name' => 'Join Discord Guild Button',
            'description' => 'Display a "Join Discord guild" button'
        ],
    ],
    'console' => [
        'bot_not_found' => 'The bot was not found',
        'bot_going_online' => 'Bot is going online...',
        'bot_online' => 'Bot is now online!',
        'says' => 'says',
        'params' => [
            'bot' => 'Bot ID',
            'log' => 'Enable Logging',
            'info' => 'Enable info log',
        ],
    ],
    'discord' => [
        'bot_guild_required' => 'Bot ID and Guild ID are required',
        'bot_required' => 'Bot ID is required',
        'no_user_found' => 'No Discord User found',
        'no_valid_token' => 'No valid token',
        'no_valid_auth' => 'No valid authorization code',
        'joined_guild' => 'You have been added to the guild',
        'logged_id' => 'You are now logged in',
        'account_created' => 'Your account have been created and you are now logged in',
    ],
    'guild' => [
        'name' => 'Guild Name',
        'description' => 'Guild Description',
        'id' => 'Guild ID',
        'manage_guilds' => 'Manage guilds',
        'create_guild' => 'Create a new guild',
        'edit_guild' => 'Edit guild',
    ],
    'bot' => [
        'name' => 'Bot Name',
        'client_id' => 'Client ID',
        'client_secret' => 'Client Secret',
        'id' => 'Bot ID',
        'token' => 'Bot Token',
        'manage_bots' => 'Manage bots',
        'create_bot' => 'Create a new bot',
        'edit_bot' => 'Edit bot',
    ],
    'menu' => [
        'main-menu' => 'Discord API',
        'guilds' => 'Guilds',
        'bots' => 'Bots',
    ],
    'message' => [
        'send' => 'Send Message',
        'placeholder' => 'Write a message in #',
    ],
    'bot_label' => 'Bot',
    'guild_label' => 'Guild',
    'select_bot' => 'Select a Bot',
    'select_guild' => 'Select a Guild',
    'view_members' => 'View Guild Members',
    'allow_send_messages' => 'Allow to send messages',
    'allow_send_messages_desc' => 'You need to enable gateway once before sending messages',
    'join_discord_guild' => 'Join Discord Guild',
    'login_with_discord' => 'Login with Discord',
];