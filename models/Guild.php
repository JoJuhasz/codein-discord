<?php namespace Codein\Discord\Models;

use Model;

/**
 * Model
 */
class Guild extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'codein_discord_guilds';
}