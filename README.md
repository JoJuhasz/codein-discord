[![Codacy Badge](https://api.codacy.com/project/badge/Grade/da390af857bc4932af0cd5f93ef8fbdb)](https://www.codacy.com/app/JoJuhasz/codein-discord?utm_source=github.com&utm_medium=referral&utm_content=JoJuhasz/codein-discord&utm_campaign=badger)
[![Build Status](https://travis-ci.org/JoJuhasz/codein-discord.svg?branch=master)](https://travis-ci.org/JoJuhasz/codein-discord)

# codein-discord
OctoberCMS Plugin - Discord API integration

## Requirements
This plugin requires the [Ajax Framework](https://octobercms.com/docs/cms/ajax) to be included in your layout/page in order to handle channel/messages requests.
This plugin requires the [RainLab.User](https://octobercms.com/docs/cms/ajax) plugin to be installed in order to handle account login/register with Discord.

# Codein.Discord
Find this plugin on Github: https://github.com/JoJuhasz/codein-discord
## Discord integration plugin for October CMS
Discord is an all-in-one voice and text chat for gamers that’s free, secure, and works on both desktop and mobile.
## Features
* Live preview of your Discord server with the "Discord App" component.
* Login/Register to your website using a Discord account with "Login with Discord" component.
* Allow your visitors to join your Discord server in one click with the "Join Discord Guild" component.

## Dependencies
* RainLab.User http://octobercms.com/plugin/rainlab-user https://github.com/rainlab/user-plugin

## Prerequisites
* To use this plugin, you need to be registered on [Discordapp.com](https://discordapp.com/register).


## Discord Application preparation
In order to use this plugin, you need to have your own **Discord Server** (aka "**Guild**") and your **Discord App**, with a **Bot** associated.

* [Create a new Discord Server](https://support.discordapp.com/hc/en-us/articles/204849977-How-do-I-create-a-server-)
* [Create a new Discord Application](https://discordapp.com/developers/applications/me/create)

## Discord Application configuration
#### Application name
Your application name is important, it is displayed on OAuth2.0 pages.
You have to choose a name corresponding to your website, in which your visitors will be confident.
#### Redirect URI(S)
When processing OAuth2.0 requests, your visitors will temporarily leave your website.
Don't worry ! Once authorization granted, the visitor will be redirected to a specific page of your website.
All the possible redirection URIs have to be communicated to Discord. If you don't specify the correct URIs here, you'll get an error when your visitors try to authenticate with Discord.
** Required URIs **
This is the required URIs that you need to encode:
* http://www.yourdomain.com/discord/login
* http://www.yourdomain.com/discord/join

#### Application description
Well, this is the application short description.
#### Application icon
The icon will be displayed on the authorization pages.
It'll also be used as the Bot avatar when writing messages.
## Bot User configuration
Once your application created, the application page will reload.
You are now able to create a Bot user for your application by clicking the appropriate button "Create a bot user".
After creating the bot, you now have access to all your application credentials.
Keep this page open, you will need these informations in your plugin configuration.

## Plugin configuration
After installing the plugin, you can add Guilds and Bots in the backend area under the menu "Discord API".

* A Guild (think as it as a server) is composed of a Guild ID, a name and a description.
While the name and description are not important, the Guild ID is mandatory. You can find your Guild ID by going into the "Widget" tab of your server settings as the "Server Identifier (ID)".
* A Bot is composed of a "Bot Name", a "Bot Token", a "Client ID" and a "Client Secret".
You will find these informations on your Application page (described below).

Once the Guilds and Bots are configured, you are ready to add the plugin components on any page you want.

## Discord permissions
In order to allow your Bot to fetch your Guild data, this one needs to be authorized on your Guild.
You can do this simply by clicking on the link "Add bot to server" on the bottom of the "Edit Bot" backend page.
The Bot will have full access to the Guild.
Anyway, only the channels that are accessible to **@everyone** role will be displayed.

## Discord Gateway
Sending messages on Discord from the website is not possible by default.
In order to be authorized to send messages, you have to connect at least one time your bot to the guild.
This is the purpose of the Discord Gateway. This plugin comes with a custom artisan command, which can connect your bot to the Gateway.
~~~
php artisan discord:gateway:run --bot=ID --info --log
~~~
* Bot option is the ID of the bot you want to connect to the Discord gateway.
* Log option will enable all the logging and the output will be sent directly in your console.
* Info option will enable some info logging when a message is sent.

Once you see your bot online, you're able to send messages from the website.
(Of course, don't forget to tick the component property allowing to send messages)

## Styling
This plugin comes with a default .scss stylesheet and a compiled .css file.
The default HTML code is based on ['Bootstrap 4'](https://v4-alpha.getbootstrap.com/) but we will release in a near future a backward compatible update with a more compatible HTML code (anyway don't forget you can fork the components anytime).

## Vendor credits
This plugin is using vendor packages, we thanks developers for making good work !
* **teamreflex/DiscordPHP** https://github.com/teamreflex/DiscordPHP https://discordphp.readme.io/
* **guzzle/guzzle** https://github.com/guzzle/guzzle http://docs.guzzlephp.org/en/latest/

## Donations
* We want to keep this plugin free, you appreciate it ? Consider making a small donation. Thanks !

## About the author
Codein.be - Jonathan Juhasz
Web Developer for 10years+ and passionated by my work, i'm always trying to deliver quality products to the largest number.
Based in Belgium, we offer quality web development services for companies and individuals.