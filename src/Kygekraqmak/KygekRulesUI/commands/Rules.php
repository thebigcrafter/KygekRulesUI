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
  
  private $plugin

  public function getPlugin() : Plugin{
    return $this->plugin;
  }

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
    parent::__construct("rules");
    $this->setDescription($this->plugin->getConfig()->get("command-description"));
    $this->setAliases($this->plugin->getConfig()->get("command-aliases"));
  }

  public function execute(CommandSender $player, string $label, array $args) {
    if (!$player instanceof Player) {
      $player->sendMessage("[KygekRulesUI] This command only works in game!");
    } else {
      if (!$player->hasPermission("rules.command")) {
        $player->sendMessage("[KygekRulesUI] You do not have permission to use this command!");
      } else {
        $this->plugin->getConfig()->reload();
        $this->plugin->kygekRulesUI($player);
      }
    }
    return true;
  }

}
