<?php

declare(strict_types=1);

namespace SkyBlock\island\settings;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use SkyBlock\Main;

class PvPOption
{
    public function __construct(private Main $plugin)
    {
    }

    public function enablePvP(Player $islandOwner): void
    {
        $islandcfg = new Config($this->plugin->getDataFolder() . $islandOwner->getName() . ".json", Config::JSON);
        $islandcfg->set("pvp", "true");
        $islandcfg->save();
        $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du hast PvP §aaktiviert§7!");
    }

    public function disablePvP(Player $islandOwner): void
    {
        $islandcfg = new Config($this->plugin->getDataFolder() . $islandOwner->getName() . ".json", Config::JSON);
        $islandcfg->set("pvp", "false");
        $islandcfg->save();
        $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du hast PvP §cdeaktiviert§7!");
    }
}