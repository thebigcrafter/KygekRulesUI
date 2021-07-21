<?php

# A plugin for PocketMine-MP that will show rules of a server in an UI form.
# Copyright (C) 2020-2021 Kygekraqmak, KygekTeam
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

use jojoe77777\FormAPI\SimpleForm;
use KygekTeam\KtpmplCfs\KtpmplCfs;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->getServer()->getCommandMap()->register("KygekRulesUI", new Commands(
            $this, $this->getConfig()->get("command-desc"),
            $this->getConfig()->get("command-aliases")
        ));
        KtpmplCfs::checkUpdates($this);
        KtpmplCfs::checkConfig($this, "2.0-ALPHA");
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
