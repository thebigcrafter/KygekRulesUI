<?php

# A plugin for PocketMine-MP that will show rules of a server in an UI form.
# Copyright (C) 2020 Kygekraqmak
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <https://www.gnu.org/licenses/>.

namespace Kygekraqmak\KygekRulesUI\commands;

use pocketmine\command\{Command, CommandSender, PluginIdentifiableCommand};
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use Kygekraqmak\KygekRulesUI\Main;

class Rules extends Command implements PluginIdentifiableCommand {

  public function getPlugin() : Plugin{
    return Main::getInstance();
  }

  public function __construct() {
    parent::__construct("rules");
    $this->setDescription(Main::getInstance()->getConfig()->get("command-description"));
    $this->setAliases(Main::getInstance()->getConfig()->get("command-aliases"));
  }

  public function execute(CommandSender $player, string $label, array $args) {
    if (!$player instanceof Player) {
      $player->sendMessage("[KygekRulesUI] This command only works in game!");
    } else {
      if (!$player->hasPermission("rules.command")) {
        $player->sendMessage("[KygekRulesUI] You do not have permission to use this command!");
      } else {
        Main::getInstance()->getConfig()->reload();
        Main::getInstance()->kygekRulesUI($player);
      }
    }
    return true;
  }

}
