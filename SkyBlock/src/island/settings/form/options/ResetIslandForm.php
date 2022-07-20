<?php

declare(strict_types=1);

namespace SkyBlock\island\settings\form\options;

use pocketmine\player\Player;
use SkyBlock\apis\pmforms\ModalForm;
use SkyBlock\island\settings\ResetIsland;
use SkyBlock\Main;

class ResetIslandForm
{
    public function __construct(private Main $plugin)
    {
    }

    public function openResetIslandForm(): ModalForm
    {
        return new ModalForm(
            "§cInsel löschen",
            "§7Wenn du deine Insel löscht wird eine neue erstellt! Du verlierst all deine Items und alle Helfer werden entfern!",
            function (Player $submitter, bool $choice): void {
                if ($choice === true) {
                    $resetIsland = new ResetIsland($this->plugin);
                    $resetIsland->reset($submitter);
                } else {
                    //nichts
                }
            },
            "§aInsel löschen",
            "§cZurück"
        );
    }
}