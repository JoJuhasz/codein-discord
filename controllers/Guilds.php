<?php namespace Codein\Discord\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Guilds extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'manage_guilds' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Codein.Discord', 'codein-discord-main-menu', 'codein-discord-guilds-submenu');
    }
}