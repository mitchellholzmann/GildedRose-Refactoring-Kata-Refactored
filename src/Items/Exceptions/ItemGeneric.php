<?php

declare(strict_types=1);

namespace GildedRose\Items\Exceptions;

use GildedRose\Items\Item;

class ItemGeneric extends Item
{
    public function update(): void
    {
        parent::update();

        $this->decrementQuality();
    }
}