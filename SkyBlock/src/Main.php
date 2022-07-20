<?php

declare(strict_types=1);

namespace SkyBlock;

use AssertionError;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\world\generator\GeneratorManager;
use pocketmine\world\Position;
use SkyBlock\island\generator\IslandGenerator;
use SkyBlock\island\LoadAll;
use SkyBlock\island\settings\form\SettingsForm;

class Main extends PluginBase
{
    public function onLoad(): void
    {
        GeneratorManager::getInstance()->addGenerator(IslandGenerator::class, "skyblock", fn() => null, true);
    }

    public function onEnable(): void
    {
        $worlds = new LoadAll($this);
        $worlds->load();

        $this->getServer()->getPluginManager()->registerEvents(new Events($this), $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "island":
            case "i":
            case "is":
                if ($sender instanceof Player) {
                    if ($sender->hasPermission("skyblock.default.commands")) {
                        if (!isset($args[0])) {
                            $sender->sendMessage("§8-=== §aSkyBlock §8===-");
                            $sender->sendMessage("§7/island home (Spieler) §8->");
                            $sender->sendMessage("§8» §7Teleportiere dich zu deiner Insel oder zu einer eines Spielers!");
                            $sender->sendMessage("§7/island settings §8->");
                            $sender->sendMessage("§8» §7Ändere die Einstellungen deiner Insel!");
                            $sender->sendMessage("§8-=== §aSkyBlock §8===-");
                        } elseif ($args[0] === "h" or $args[0] === "home") {
                            if (!isset($args[1])) {
                                $world = $this->getServer()->getWorldManager()->getWorldByName($sender->getName());
                                $worldX = $world->getSpawnLocation()->getX();
                                $worldY = $world->getSpawnLocation()->getY();
                                $worldZ = $world->getSpawnLocation()->getZ();
                                $sender->teleport(new Position($worldX, $worldY, $worldZ, $world));

                                $sender->sendMessage("§8[§aSkyBlock§8] §7Du wurdest zu deiner Insel teleportiert!");
                            } else {
                                $island = $args[1];
                                if (file_exists($this->getServer()->getDataPath() . "worlds/{$island}")) {
                                    $world = $this->getServer()->getWorldManager()->getWorldByName($island);
                                    $worldX = $world->getSpawnLocation()->getX();
                                    $worldY = $world->getSpawnLocation()->getY();
                                    $worldZ = $world->getSpawnLocation()->getZ();
                                    $sender->teleport(new Position($worldX, $worldY, $worldZ, $world));

                                    $sender->sendMessage("§8[§aSkyBlock§8] §7Du wurdest zu der Insel von {$island} teleportiert!");
                                } else {
                                    $sender->sendMessage("§8[§aSkyBlock§8] §7Den Spieler {$island} gibt es nicht!");
                                }
                            }
                        } elseif ($args[0] === "settings") {
                            $settingsFormFile = new SettingsForm($this);
                            $settingsForm = $settingsFormFile->sendSettingsForm();
                            $sender->sendForm($settingsForm);
                        }
                    }
                }
                return true;
            default:
                throw new AssertionError("");
        }
    }
}