<?php

declare(strict_types=1);

namespace SkyBlock\island\generator;

use pocketmine\world\ChunkManager;
use pocketmine\world\generator\Generator;
use SkyBlock\island\generator\populator\Island;

class IslandGenerator extends Generator
{
    public function __construct(int $seed, string $preset)
    {
        parent::__construct($seed, $preset);
    }

    public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void
    {
    }

    public function populateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void
    {
        if ($chunkX == 16 and $chunkZ == 16) {
            $island = new Island();
            $island->populate($world, $chunkX, $chunkZ, $this->random);
        }
    }
}