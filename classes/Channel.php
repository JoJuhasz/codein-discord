<?php

namespace Codein\Discord\Classes;

class Channel
{

    public $roleId;
    public $guildPerm;
    public $channelPerm;
    public $permissionManager;

    public function __construct()
    {
    }


    public function canAccess($channel, $role)
    {
        $this->permissionManager = new Permissions();
        $this->guildPerm = $this->permissionManager->decodeBitwise($role->permissions);

        $roleId = $role->id;
        
        $permissions = $channel->permission_overwrites;
        foreach ($permissions as $permission) {
            if($permission->type == "role" && $permission->id == $roleId) {
                $this->channelPerm = $this->permissionManager->decodeChannelBitwise($permission->allow, $permission->deny);
            }
        }


        if(!is_null($this->channelPerm['READ_MESSAGES'])) {
            return $this->channelPerm['READ_MESSAGES'];
        } else {
            return $this->guildPerm['READ_MESSAGES'];
        }
        
    }
    
    

}