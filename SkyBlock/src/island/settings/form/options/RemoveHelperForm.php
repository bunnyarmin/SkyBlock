<?php

declare(strict_types=1);

namespace SkyBlock\island\settings\form\options;

use pocketmine\player\Player;
use SkyBlock\apis\pmforms\CustomForm;
use SkyBlock\apis\pmforms\CustomFormResponse;
use SkyBlock\apis\pmforms\element\Input;
use SkyBlock\island\settings\RemoveHelper;
use SkyBlock\Main;

class RemoveHelperForm
{
    public function __construct(private Main $plugin)
    {
    }

    public function sendRemoveHelperForm(): CustomForm
    {
        return new CustomForm(
            "§cHelfer entfernen",
            [
                new Input("player", "§7Spielername")
            ],
            function (Player $submitter, CustomFormResponse $response): void {
                $helper = $response->getString("player");

                if (file_exists($this->plugin->getDataFolder() . $helper . ".json")) {
                    $helperPlayer = $this->plugin->getServer()->getPlayerExact($helper);
                    if ($helperPlayer->isOnline()) {
                        $add = new RemoveHelper($this->plugin);
                        $add->removeHelper($submitter, $helperPlayer);
                    } else {
                        $submitter->sendMessage("§8[§aSkyBlock§8] §cDer Spieler {$helper} muss Online sein!");
                    }
                } else {
                    $submitter->sendMessage("§8[§aSkyBlock§8] §cDen Spieler {$helper} gibt es nicht!");
                }
            }
        );
    }

}