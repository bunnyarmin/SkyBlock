<?php

declare(strict_types=1);

namespace SkyBlock\island;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\world\generator\GeneratorManager;
use pocketmine\world\WorldCreationOptions;
use SkyBlock\Main;

class CreateIsland
{
    public function __construct(private Main $plugin)
    {
    }

    public function generateIslandFor(Player $islandOwner): void
    {
        $generator = GeneratorManager::getInstance()->getGenerator("skyblock");
        $this->plugin->getServer()->getWorldManager()->generateWorld(
            $islandOwner->getName(),
            WorldCreationOptions::create()
                ->setGeneratorClass($generator->getGeneratorClass())
        );
        $this->plugin->getServer()->getWorldManager()->loadWorld($islandOwner->getName());

        $islandcfg = new Config($this->plugin->getDataFolder() . $islandOwner->getName() . ".json", Config::JSON);
        $islandcfg->set("owner", $islandOwner->getName());
        $islandcfg->set("helper", 0);
        $islandcfg->set("helper1", "");
        $islandcfg->set("helper2", "");
        $islandcfg->set("helper3", "");
        $islandcfg->set("helper4", "");
        $islandcfg->set("helper5", "");
        $islandcfg->set("pvp", "false");
        $islandcfg->save();

        $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Deine Insel wurde §aerstellt§7!");
    }
}