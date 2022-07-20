<?php

declare(strict_types=1);

namespace SkyBlock\island\generator\populator;

use pocketmine\block\VanillaBlocks;
use pocketmine\math\Vector3;
use pocketmine\utils\Random;
use pocketmine\world\ChunkManager;
use pocketmine\world\generator\object\OakTree;
use pocketmine\world\generator\populator\Populator;

class Island implements Populator
{
    public function populate(ChunkManager $world, int $chunkX, int $chunkZ, Random $random): void
    {
        $center = new Vector3(256, 67, 256);

        for ($x = -2; $x <= 2; $x++) {
            for ($y = -2; $y <= 2; $y++) {
                for ($z = -2; $z <= 2; $z++) {
                    $centerVec = $center->add($x, $y, $z);
                    if ($centerVec->getY() == 69) {
                        $world->setBlockAt($centerVec->getX(), $centerVec->getY(), $centerVec->getZ(), VanillaBlocks::GRASS());
                    } else {
                        $world->setBlockAt($centerVec->getX(), $centerVec->getY(), $centerVec->getZ(), VanillaBlocks::DIRT());
                    }

                    $leftVec = $center->add($x, $y, $z)->add(3, 0, 0);
                    if ($leftVec->getY() == 69) {
                        $world->setBlockAt($leftVec->getX(), $leftVec->getY(), $leftVec->getZ(), VanillaBlocks::GRASS());
                    } else {
                        $world->setBlockAt($leftVec->getX(), $leftVec->getY(), $leftVec->getZ(), VanillaBlocks::DIRT());
                    }

                    $rightVec = $center->add($x, $y, $z)->add(0, 0, 3);
                    if ($rightVec->getY() == 69) {
                        $world->setBlockAt($rightVec->getX(), $rightVec->getY(), $rightVec->getZ(), VanillaBlocks::GRASS());
                    } else {
                        $world->setBlockAt($rightVec->getX(), $rightVec->getY(), $rightVec->getZ(), VanillaBlocks::DIRT());
                    }

                    $behindVec = $center->add($x, $y, $z)->add(-3, 0, 0);
                    if ($behindVec->getY() == 69) {
                        $world->setBlockAt($behindVec->getX(), $behindVec->getY(), $behindVec->getZ(), VanillaBlocks::GRASS());
                    } else {
                        $world->setBlockAt($behindVec->getX(), $behindVec->getY(), $behindVec->getZ(), VanillaBlocks::DIRT());
                    }

                    $downVec = $center->add($x, $y, $z)->subtract(0, 0, 3);
                    if ($leftVec->getY() == 69) {
                        $world->setBlockAt($downVec->getX(), $downVec->getY(), $downVec->getZ(), VanillaBlocks::GRASS());
                    } else {
                        $world->setBlockAt($downVec->getX(), $downVec->getY(), $downVec->getZ(), VanillaBlocks::DIRT());
                    }
                }
            }
        }
        $treeVec = $center->add(4, 3, 0);

        $tree = new OakTree();
        $tree->getBlockTransaction($world, $treeVec->getX(), $treeVec->getY(), $treeVec->getZ(), $random)->apply();

        $world->setBlockAt($center->getX(), $center->getY() + 2, $center->getZ(), VanillaBlocks::BEDROCK());
    }
}