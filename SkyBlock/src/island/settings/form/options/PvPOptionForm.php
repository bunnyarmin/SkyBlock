<?php

declare(strict_types=1);

namespace SkyBlock\island\settings\form\options;

use pocketmine\player\Player;
use SkyBlock\apis\pmforms\CustomForm;
use SkyBlock\apis\pmforms\CustomFormResponse;
use SkyBlock\apis\pmforms\element\Toggle;
use SkyBlock\island\settings\PvPOption;
use SkyBlock\Main;

class PvPOptionForm
{
    public function __construct(private Main $plugin)
    {
    }

    public function openPvPOptionForm(): CustomForm
    {
        return new CustomForm(
            "§cPvP Einstellungen",
            [
                new Toggle("pvp", "§cPvP de-/aktivieren", false)
            ],
            function (Player $submitter, CustomFormResponse $response): void {
                $pvp = $response->getBool("pvp");

                $pvpManager = new PvPOption($this->plugin);

                if ($pvp === false) {
                    $pvpManager->disablePvP($submitter);
                } else {
                    $pvpManager->enablePvP($submitter);
                }
            }
        );
    }
}