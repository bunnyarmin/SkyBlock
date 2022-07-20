<?php

declare(strict_types=1);

namespace SkyBlock\island;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use SkyBlock\Main;

class IslandManager
{
    public function __construct(private Main $plugin)
    {
    }

    public function checkIfPvPIsActiv(Player $player): bool
    {
        $world = $player->getWorld()->getFolderName();

        $islandcfg = new Config($this->plugin->getDataFolder() . $world . ".json", Config::JSON);

        if ($islandcfg->get("pvp") === "false") {
            return true;
        }
        return false;
    }

    public function checkIfPlayerHasPermissions(Player $player): bool
    {
        $world = $player->getWorld()->getFolderName();

        $islandcfg = new Config($this->plugin->getDataFolder() . $world . ".json", Config::JSON);
        $owner = $islandcfg->get("owner");
        $helper1 = $islandcfg->get("helper1");
        $helper2 = $islandcfg->get("helper2");
        $helper3 = $islandcfg->get("helper3");
        $helper4 = $islandcfg->get("helper4");
        $helper5 = $islandcfg->get("helper5");

        if ($owner === $player->getName() or $helper1 === $player->getName() or $helper2 === $player->getName() or $helper3 === $player->getName() or $helper4 === $player->getName() or $helper5 === $player->getName()) {
            return true;
        } else {
            return false;
        }
    }
}