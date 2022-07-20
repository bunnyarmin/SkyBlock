<?php

declare(strict_types=1);

namespace SkyBlock\island\settings;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use SkyBlock\Main;

class AddHelper
{
    public function __construct(private Main $plugin)
    {
    }

    public function setHelper(Player $islandOwner, Player $helper): void
    {
        $islandcfg = new Config($this->plugin->getDataFolder() . $islandOwner->getName() . ".json", Config::JSON);
        $helperCount = $islandcfg->get("helper");
        $owner = $islandcfg->get("owner");
        $helper1 = $islandcfg->get("helper1");
        $helper2 = $islandcfg->get("helper2");
        $helper3 = $islandcfg->get("helper3");
        $helper4 = $islandcfg->get("helper4");
        $helper5 = $islandcfg->get("helper5");

        if ($owner !== $helper->getName()) {
            if ($helper1 !== $helper->getName() or $helper2 !== $helper->getName() or $helper3 !== $helper->getName() or $helper4 !== $helper->getName() or $helper5 !== $helper->getName()) {
                if ($helper1 === "") {
                    $islandcfg->set("helper1", $helper->getName());
                    $islandcfg->set("helper", $helperCount + 1);
                    $islandcfg->save();
                } elseif ($helper2 === "") {
                    $islandcfg->set("helper2", $helper->getName());
                    $islandcfg->set("helper", $helperCount + 1);
                    $islandcfg->save();
                } elseif ($helper3 === "") {
                    $islandcfg->set("helper3", $helper->getName());
                    $islandcfg->set("helper", $helperCount + 1);
                    $islandcfg->save();
                } elseif ($helper4 === "") {
                    $islandcfg->set("helper4", $helper->getName());
                    $islandcfg->set("helper", $helperCount + 1);
                    $islandcfg->save();
                } elseif ($helper5 === "") {
                    $islandcfg->set("helper5", $helper->getName());
                    $islandcfg->set("helper", $helperCount + 1);
                    $islandcfg->save();
                }
            } else {
                $islandOwner->sendMessage("§8[§aSkyBlock§8] §c{$helper->getName()} §7ist bereits ein Helfer!");
            }
        } else {
            $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du kannst §cdir nicht selbst §7Helfer geben!");
        }

        if ($owner !== $helper->getName()) {
            $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du hast §a{$helper->getName()} §7Helfer gegeben!");
        }
    }
}