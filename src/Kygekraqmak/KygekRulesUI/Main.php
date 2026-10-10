<?php

/*
 * A plugin for PocketMine-MP that will show rules of a server in an UI form.
 * Copyright (C) 2020-2023 Kygekraqmak, KygekTeam
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace Kygekraqmak\KygekRulesUI;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use thebigcrafter\Hydrogen\HConfig;
use thebigcrafter\Hydrogen\Hydrogen;
use Vecnavium\FormsUI\SimpleForm;
use function array_filter;
use function array_values;
use function is_array;
use function is_string;
use function str_replace;

class Main extends PluginBase {

	protected function onEnable() : void {
		$this->saveDefaultConfig();

		$this->getServer()->getCommandMap()->register("KygekRulesUI", new Commands(
			$this, $this->getStringConfig("command-desc"),
			$this->getAliases()
		));

		Hydrogen::checkForUpdates($this);
		HConfig::verifyConfigVersion($this->getConfig(), "2.2");
	}

	public function kygekRulesUI(Player $player) : void {
		$form = new SimpleForm(function (Player $player, ?int $data = null) : bool {
			if ($data === null) {
				return true;
			}
			return true;
		});
		$title = str_replace("{player}", $player->getName(), TextFormat::colorize($this->getStringConfig("title")));
		$content = str_replace("{player}", $player->getName(), TextFormat::colorize($this->getStringConfig("content")));
		$button = str_replace("{player}", $player->getName(), TextFormat::colorize($this->getStringConfig("button")));
		$form->setTitle($title);
		$form->setContent($content);
		$form->addButton($button);
		$player->sendForm($form);
	}

	private function getStringConfig(string $key) : string {
		$value = $this->getConfig()->get($key, "");
		return is_string($value) ? $value : "";
	}

	/** @return list<string> */
	private function getAliases() : array {
		$value = $this->getConfig()->get("command-aliases", []);
		return is_array($value) ? array_values(array_filter($value, is_string(...))) : [];
	}

}
