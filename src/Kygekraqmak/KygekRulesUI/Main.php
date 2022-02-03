<?php

# A plugin for PocketMine-MP that will show rules of a server in an UI form.
# Copyright (C) 2020-2022 Kygekraqmak, KygekTeam
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

use KygekTeam\KtpmplCfs\KtpmplCfs;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use Vecnavium\FormsUI\SimpleForm;

class Main extends PluginBase {

    private const IS_DEV = false;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        $ktpmplcfs = new KtpmplCfs($this);

        /** @phpstan-ignore-next-line */
        if (self::IS_DEV) {
            $ktpmplcfs->warnDevelopmentVersion();
        }

        $this->getServer()->getCommandMap()->register("KygekRulesUI", new Commands(
            $this, $this->getConfig()->get("command-desc"),
            $this->getConfig()->get("command-aliases")
        ));

        $ktpmplcfs->checkUpdates();
        $ktpmplcfs->checkConfig("2.1");
    }

    public function kygekRulesUI(Player $player) {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if ($data === null) {
                return true;
            }
        });
        $title = str_replace("{player}", $player->getName(), TextFormat::colorize($this->getConfig()->get("title")));
        $content = str_replace("{player}", $player->getName(), TextFormat::colorize($this->getConfig()->get("content")));
        $button = str_replace("{player}", $player->getName(), TextFormat::colorize($this->getConfig()->get("button")));
        $form->setTitle($title);
        $form->setContent($content);
        $form->addButton($button);
        $player->sendForm($form);
    }

}
