<?php

declare(strict_types=1);

namespace SkyBlock\island\settings\form;

use pocketmine\player\Player;
use SkyBlock\apis\pmforms\MenuForm;
use SkyBlock\apis\pmforms\MenuOption;
use SkyBlock\island\settings\form\options\AddHelperForm;
use SkyBlock\island\settings\form\options\PvPOptionForm;
use SkyBlock\island\settings\form\options\RemoveHelperForm;
use SkyBlock\island\settings\form\options\ResetIslandForm;
use SkyBlock\Main;

class SettingsForm
{
    public function __construct(private Main $plugin)
    {
    }

    public function sendSettingsForm(): MenuForm
    {
        return new MenuForm(
            "§aSkyBlock Insel",
            "§7Einstellungen",
            [
                new MenuOption("§aHelfer hinzufügen"),
                new MenuOption("§cHelfer entfernen"),
                new MenuOption("§bPvP an-/ausschalten"),
                new MenuOption("§4Insel löschen")
            ],
            function (Player $submitter, int $selected): void {
                switch ($selected) {
                    case 0:
                        $addFormFile = new AddHelperForm($this->plugin);
                        $addForm = $addFormFile->sendAddHelperForm();
                        $submitter->sendForm($addForm);
                        break;
                    case 1:
                        $rmFormFile = new RemoveHelperForm($this->plugin);
                        $rmForm = $rmFormFile->sendRemoveHelperForm();
                        $submitter->sendForm($rmForm);
                        break;
                    case 2:
                        $pvpFormFile = new PvPOptionForm($this->plugin);
                        $pvpForm = $pvpFormFile->openPvPOptionForm();
                        $submitter->sendForm($pvpForm);
                        break;
                    case 3:
                        $resetFormFile = new ResetIslandForm($this->plugin);
                        $resetForm = $resetFormFile->openResetIslandForm();
                        $submitter->sendForm($resetForm);
                        break;
                }
            }
        );
    }
}