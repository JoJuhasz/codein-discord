<?php return [
    'plugin' => [
        'name' => 'Discord',
        'description' => 'Intégration de l\'API Discord',
    ],
    'component' => [
        'app' => [
            'name' => 'Application Discord',
            'description' => 'Affiche une prévisualisation de votre serveur Discord'
        ],
        'login' => [
            'name' => 'Boutton "Se connecter avec Discord"',
            'description' => 'Affiche un bouton "Se connecter avec Discord"'
        ],
        'join' => [
            'name' => 'Boutton "Rejoindre le serveur Discord"',
            'description' => 'Affiche un bouton "Rejoindre le serveur Discord"'
        ],
    ],
    'console' => [
        'bot_not_found' => 'Impossible de trouver le Bot',
        'bot_going_online' => 'Le Bot va passer en ligne...',
        'bot_online' => 'Le Bot est à présent en ligne!',
        'says' => 'dit',
        'params' => [
            'bot' => 'ID du Bot',
            'log' => 'Activer le log',
            'info' => 'Afficher les informations',
        ],
    ],
    'discord' => [
        'bot_guild_required' => 'L\'ID du Bot et du serveur sont obligatoires',
        'bot_required' => 'L\'ID du Bot est obligatoire',
        'no_user_found' => 'Aucun utilisateur Discord trouvé',
        'no_valid_token' => 'Le token fourni est invalide',
        'no_valid_auth' => 'Le code d\'autorisation est invalide ou a expiré',
        'joined_guild' => 'Vous avez été ajouté au serveur',
        'logged_id' => 'Vous êtes à présent connecté',
        'account_created' => 'Votre compte à bien été créé et vous êtes à présent connecté',
    ],
    'guild' => [
        'name' => 'Nom du serveur',
        'description' => 'Description du serveur',
        'id' => 'ID du serveur',
        'manage_guilds' => 'Gérer les serveurs',
        'create_guild' => 'Créer un serveur',
        'edit_guild' => 'Modifier un serveur',
    ],
    'bot' => [
        'name' => 'Nom du Bot',
        'client_id' => 'Client ID',
        'client_secret' => 'Client Secret',
        'id' => 'ID du Bot',
        'token' => 'Token du Bot',
        'manage_bots' => 'Gérer les bots',
        'create_bot' => 'Créer un bot',
        'edit_bot' => 'Modifier un bot',
    ],
    'menu' => [
        'main-menu' => 'Discord API',
        'guilds' => 'Serveurs',
        'bots' => 'Bots',
    ],
    'message' => [
        'send' => 'Envoyer le message',
        'placeholder' => 'Envoyer un message dans #',
    ],
    'bot_label' => 'Bot',
    'guild_label' => 'Serveur',
    'select_bot' => 'Sélectionner un Bot',
    'select_guild' => 'Sélectionner un Serveur',
    'view_members' => 'Afficher les membres',
    'allow_send_messages' => 'Autoriser l\'envoi de messages',
    'allow_send_messages_desc' => 'Vous devez vous connecter au moins une fois à la passerelle',
    'join_discord_guild' => 'Rejoindre le Serveur',
    'login_with_discord' => 'Se connecter avec Discord',
];