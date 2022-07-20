<?php

declare(strict_types=1);

namespace SkyBlock;

use pocketmine\block\BlockLegacyIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\player\Player;
use pocketmine\world\Position;
use SkyBlock\island\CreateIsland;
use SkyBlock\island\IslandManager;

class Events implements Listener
{
    public function __construct(private Main $plugin)
    {
    }

    public function onLogin(PlayerLoginEvent $event): void
    {
        $player = $event->getPlayer();

        if (!file_exists($this->plugin->getDataFolder() . $player->getName() . ".json")) {
            $gen = new CreateIsland($this->plugin);
            $gen->generateIslandFor($player);
        }
    }

    public function onBreak(BlockBreakEvent $event): void
    {
        $player = $event->getPlayer();

        $manager = new IslandManager($this->plugin);
        if ($manager->checkIfPlayerHasPermissions($player) !== true) {
            $event->cancel();
        }
    }

    public function onPlace(BlockPlaceEvent $event): void
    {
        $player = $event->getPlayer();

        $manager = new IslandManager($this->plugin);
        if ($manager->checkIfPlayerHasPermissions($player) !== true) {
            $event->cancel();
        }
    }

    public function onChest(PlayerInteractEvent $event): void
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();

        if ($block->getId() === BlockLegacyIds::CHEST) {
            $manager = new IslandManager($this->plugin);
            if ($manager->checkIfPlayerHasPermissions($player) !== true) {
                $event->cancel();
            }
        }
    }

    public function onDamage(EntityDamageEvent $event): void
    {
        $player = $event->getEntity();

        if ($player instanceof Player) {
            if ($event->getCause() === $event::CAUSE_VOID) {
                $world = $this->plugin->getServer()->getWorldManager()->getWorldByName($player->getName());
                $worldX = $world->getSpawnLocation()->getX();
                $worldY = $world->getSpawnLocation()->getY();
                $worldZ = $world->getSpawnLocation()->getZ();
                $player->teleport(new Position($worldX, $worldY, $worldZ, $world));
            }

            $manager = new IslandManager($this->plugin);
            if ($manager->checkIfPvPIsActiv($player) !== false) {
                $event->cancel();
            }
        }
    }
}