<?php

declare(strict_types=1);

namespace GildedRose\Items\Exceptions;

use GildedRose\Items\Item;

class ItemBrie extends Item
{
    public function update(): void
    {
        parent::update();

        if ($this->getQuality() < self::QUALITY_MAX) {
            $this->incrementQuality();
        }
    }
}