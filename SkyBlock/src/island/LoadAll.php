<?php

declare(strict_types=1);

namespace SkyBlock\island;

use SkyBlock\Main;

class LoadAll
{
    public function __construct(private Main $plugin)
    {
    }

    public function load(): void
    {
        //code by koningcool
        foreach (array_diff(scandir($this->plugin->getServer()->getDataPath() . "worlds"), [".", ".."]) as $levelname) {
            $this->plugin->getServer()->getWorldManager()->loadWorld($levelname);
        }
    }
}