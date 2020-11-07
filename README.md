# KygekRulesUI

A plugin that will show your server rules in UI form. To open KygekRulesUI, simply type `/rules` in the chat.

# Features

- Easy to use (you can set the `title`, `content` and `button` in the `config.yml`)
- No need to restart, config will automatically get reloaded every time the `/rules` command gets executed!
- Use `{player}` to display player name
- Use `§` as formatting codes
- Use `\n` to break into a new line
- FormAPI plugin is not required
- Automatic plugin update checker on server startup

# How to Install

1. Download the latest version (It is recommended to always download the latest version for the best experience, except you're having compatibility issues).
2. Put the .phar file to the `plugins` folder.
3. Restart the server.
4. Open the `config.yml` file in the `plugin_data/KygekRulesUI` folder to edit the `title`, `content` and `button` (NEVER TOUCH THE `config-version`!).
5. Join the server and type `/rules` in the player chat.
6. Done!

# Commands & Permissions

| Command | Default Description | Permission | Default |
| --- | --- | --- | --- |
| `/rules` | Server rules in UI form | `rules.command` | true |

Command description can be changed in `config.yml`. You can also add command aliases in `config.yml`.  
Use `-rules.command` to blacklist the `/rules` command permission to groups/users in PurePerms.

# Upcoming Features

- Currently none planned. You can contribute or suggest for new features.

# Additional Notes

- Join the Discord <a href="https://discord.gg/CXtqUZv">here</a> for latest updates from Kygekraqmak.
- If you found bugs or want to give suggestions, please visit <a href="https://github.com/Kygekraqmak/KygekRulesUI/issues">here</a> or DM KygekDev#6415 via Discord.
- We accept any contributions! If you want to contribute please make a pull request in <a href="https://github.com/Kygekraqmak/KygekRulesUI/pulls">here</a>.
