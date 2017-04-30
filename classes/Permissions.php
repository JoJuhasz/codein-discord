<?php
namespace Codein\Discord\Classes;

class Permissions
{
    public $bitwise = [
        "CREATE_INSTANT_INVITE"	=> 0, //0x00000001, //Allows creation of instant invites
        "KICK_MEMBERS"          => 1, //0x00000002, //Allows kicking members
        "BAN_MEMBERS"           => 2, //0x00000004, //Allows banning members
        "ADMINISTRATOR"         => 3, //0x00000008, //Allows all permissions and bypasses channel permission overwrites
        "MANAGE_CHANNELS"       => 4, //0x00000010, //Allows management and editing of channels
        "MANAGE_GUILD"          => 5, //0x00000020, //Allows management and editing of the guild
        "ADD_REACTIONS"         => 6, //0x00000040, //Allows for the addition of reactions to messages
        "READ_MESSAGES"         => 10, //0x00000400, //Allows reading messages in a channel. The channel will not appear for users without this permission
        "SEND_MESSAGES"         => 11, //0x00000800, //Allows for sending messages in a channel.
        "SEND_TTS_MESSAGES"     => 12, //0x00001000, //Allows for sending of /tts messages
        "MANAGE_MESSAGES"       => 13, //0x00002000, //Allows for deletion of other users messages
        "EMBED_LINKS"           => 14, //0x00004000, //Links sent by this user will be auto-embedded
        "ATTACH_FILES"          => 15, //0x00008000, //Allows for uploading images and files
        "READ_MESSAGE_HISTORY"  => 16, //0x00010000, //Allows for reading of message history
        "MENTION_EVERYONE"      => 17, //0x00020000, //Allows for using the @everyone tag to notify all users in a channel, and the @here tag to notify all online users in a channel
        "USE_EXTERNAL_EMOJIS"   => 18, //0x00040000, //Allows the usage of custom emojis from other servers
        "CONNECT"               => 20, //0x00100000, //Allows for joining of a voice channel
        "SPEAK"                 => 21, //0x00200000, //Allows for speaking in a voice channel
        "MUTE_MEMBERS"          => 22, //0x00400000, //Allows for muting members in a voice channel
        "DEAFEN_MEMBERS"        => 23, //0x00800000, //Allows for deafening of members in a voice channel
        "MOVE_MEMBERS"          => 24, //0x01000000, //Allows for moving of members between voice channels
        "USE_VAD"               => 25, //0x02000000, //Allows for using voice-activity-detection in a voice channel
        "CHANGE_NICKNAME"       => 26, //0x04000000, //Allows for modification of own nickname
        "MANAGE_NICKNAMES"      => 27, //0x08000000, //Allows for modification of other users nicknames
        "MANAGE_ROLES"          => 28, //0x10000000, //Allows management and editing of roles
        "MANAGE_WEBHOOKS"       => 29, //0x20000000, //Allows management and editing of webhooks
        "MANAGE_EMOJIS"         => 30, //0x40000000, //Allows management and editing of emojis
    ];

    public function decodeChannelBitwise($bitwise, $deny = 0)
    {
        $result = $this->getDefault();
        foreach ($this->bitwise as $key => $value) {
            if (true === ((($bitwise >> $value) & 1) == 1)) {
                $result[$key] = true;
            } elseif (true === ((($deny >> $value) & 1) == 1)) {
                $result[$key] = false;
            }
        }

        return $result;
    }

    public function decodeBitwise($bitwise)
    {
        $result = [];
        foreach ($this->bitwise as $key => $value) {
            $result[$key] = ((($bitwise >> $value) & 1) == 1);
        }

        return $result;
    }

    public function getDefault($value = null)
    {
        $default = [];
        foreach ($this->bitwise as $key => $bit) {
            $default[$key] = $value;
        }
        return $default;
    }
    
}