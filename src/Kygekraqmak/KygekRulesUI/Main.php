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

use JackMD\UpdateNotifier\UpdateNotifier;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        if ($this->getConfig()->get("config-version") !== 1.2) {
            $this->getLogger()->notice("Your configuration file is outdated, updating the config.yml...");
            $this->getLogger()->notice("The old configuration file can be found at config_old.yml");
            rename($this->getDataFolder()."config.yml", $this->getDataFolder()."config_old.yml");
            $this->saveResource("config.yml");
        }
        $this->getServer()->getCommandMap()->register("KygekRulesUI", new Commands(
            $this, $this->getConfig()->get("command-desc"),
            $this->getConfig()->get("command-aliases")
        ));
        if ($this->getConfig()->get("check-updates", true)) {
            UpdateNotifier::checkUpdate($this->getDescription()->getName(), $this->getDescription()->getVersion());
        }
    }

    public function kygekRulesUI(Player $player) {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if ($data === null) {
                return true;
            }
        });
        $title = str_replace("{player}", $player->getName(), $this->getConfig()->get("title"));
        $content = str_replace("{player}", $player->getName(), $this->getConfig()->get("content"));
        $button = str_replace("{player}", $player->getName(), $this->getConfig()->get("button"));
        $form->setTitle($title);
        $form->setContent($content);
        $form->addButton($button);
        $player->sendForm($form);
    }

}
