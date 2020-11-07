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

namespace Kygekraqmak\KygekRulesUI;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class Commands extends PluginCommand {

    private $main;

    public function __construct(Main $main, string $desc, array $aliases) {
        $this->main = $main;
        parent::__construct("rules", $main);
        $this->setPermission("kygekrulesui.rules");
        $this->setAliases($aliases);
        $this->setUsage("/rules");
        $this->setDescription((empty($desc)) ? "Server rules in UI form" : $desc);
    }

    public function getMain() : Main {
        return $this->main;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage("[KygekRulesUI] This command only works in game!");
        } else {
            if (!$sender->hasPermission("kygekrulesui.rules")) {
                $sender->sendMessage("[KygekRulesUI] You do not have permission to use this command!");
            } else {
                $this->getMain()->getConfig()->reload();
                $this->getMain()->kygekRulesUI($sender);
            }
        }
        return true;
    }

}