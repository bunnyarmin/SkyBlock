<?php

declare(strict_types=1);

namespace SkyBlock\island\settings;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use SkyBlock\Main;

class RemoveHelper
{
    public function __construct(private Main $plugin)
    {
    }

    public function removeHelper(Player $islandOwner, Player $helper): void
    {
        $islandcfg = new Config($this->plugin->getDataFolder() . $islandOwner->getName() . ".json", Config::JSON);
        $helperCount = $islandcfg->get("helper");
        $helper1 = $islandcfg->get("helper1");
        $helper2 = $islandcfg->get("helper2");
        $helper3 = $islandcfg->get("helper3");
        $helper4 = $islandcfg->get("helper4");
        $helper5 = $islandcfg->get("helper5");

        if ($helper1 === $helper->getName()) {
            $islandcfg->set("helper1", "");
            $islandcfg->set("helper", $helperCount - 1);
            $islandcfg->save();
            $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du hast §c{$helper->getName()} §7als Helper entfernt!");
        } elseif ($helper2 === $helper->getName()) {
            $islandcfg->set("helper2", "");
            $islandcfg->set("helper", $helperCount - 1);
            $islandcfg->save();
            $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du hast §c{$helper->getName()} §7als Helper entfernt!");
        } elseif ($helper3 === $helper->getName()) {
            $islandcfg->set("helper3", "");
            $islandcfg->set("helper", $helperCount - 1);
            $islandcfg->save();
            $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du hast §c{$helper->getName()} §7als Helper entfernt!");
        } elseif ($helper4 === $helper->getName()) {
            $islandcfg->set("helper4", "");
            $islandcfg->set("helper", $helperCount - 1);
            $islandcfg->save();
            $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du hast §c{$helper->getName()} §7als Helper entfernt!");
        } elseif ($helper5 === $helper->getName()) {
            $islandcfg->set("helper5", "");
            $islandcfg->set("helper", $helperCount - 1);
            $islandcfg->save();
            $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Du hast §c{$helper->getName()} §7als Helper entfernt!");
        } else {
            $islandOwner->sendMessage("§8[§aSkyBlock§8] §c{$helper->getName()} ist kein Helfer!");
        }
    }
}