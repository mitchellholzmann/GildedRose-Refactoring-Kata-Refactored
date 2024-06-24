<?php

declare(strict_types=1);

namespace GildedRose\Items\Exceptions;

use GildedRose\Items\Item;

class ItemBackstage extends Item
{
    public function update(): void
    {
        parent::update();

        if ($this->getSellIn() < 0) {
            $this->setQuality(0);
            return;
        }

        if ($this->getQuality() < self::QUALITY_MAX) {
            $this->incrementQuality();

            if ($this->getSellIn() < 11 && $this->getQuality() < self::QUALITY_MAX) {
                $this->incrementQuality();

                if ($this->getSellIn() < 6 && $this->getQuality() < self::QUALITY_MAX) {
                    $this->incrementQuality();
                }
            }
        }
    }
}