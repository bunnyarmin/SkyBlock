<?php

declare(strict_types=1);

namespace SkyBlock\island\settings;

use FilesystemIterator;
use pocketmine\player\Player;
use pocketmine\world\Position;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SkyBlock\island\CreateIsland;
use SkyBlock\Main;

class ResetIsland
{
    public function __construct(private Main $plugin)
    {
    }

    public function reset(Player $islandOwner)
    {
        $this->removeWorld($islandOwner);
        $islandOwner->sendMessage("§8[§aSkyBlock§8] §7Deine Insel wurde §cgelöscht§7!");

        $generator = new CreateIsland($this->plugin);
        $generator->generateIslandFor($islandOwner);
    }

    public function removeWorld(PLayer $islandOwner): void
    {
        if ($this->plugin->getServer()->getWorldManager()->isWorldLoaded($islandOwner->getName())) {
            $world = $this->plugin->getServer()->getWorldManager()->getWorldByName($islandOwner->getName());
            if (count($world->getPlayers()) > 0) {
                foreach ($world->getPlayers() as $player) {
                    $defaultWorld = $this->plugin->getServer()->getWorldManager()->getDefaultWorld();
                    $worldX = $defaultWorld->getSpawnLocation()->getX();
                    $worldY = $defaultWorld->getSpawnLocation()->getY();
                    $worldZ = $defaultWorld->getSpawnLocation()->getZ();
                    $islandOwner->teleport(new Position($worldX, $worldY, $worldZ, $defaultWorld));
                }
            }
            $this->plugin->getServer()->getWorldManager()->unloadWorld($world);
        }

        $removedFiles = 1;

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($worldPath = $this->plugin->getServer()->getDataPath() . "worlds/{$islandOwner->getName()}", FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $fileInfo) {
            if ($filePath = $fileInfo->getRealPath()) {
                if ($fileInfo->isFile()) {
                    unlink($filePath);
                } else {
                    rmdir($filePath);
                }
                $removedFiles++;
            }
        }
        rmdir($worldPath);
    }
}