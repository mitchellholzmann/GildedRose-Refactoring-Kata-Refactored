<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item as BaseItem;

class Item
{
    const QUALITY_MAX = 50;
    const QUALITY_MIN = 0;

    public function __construct(
        private BaseItem $item
    ) {
    }

    /**
     * Update the item
     * @return void
     */
    public function update(): void
    {
        $this->decrementSellIn();
    }

    /**
     * Increment sell in by int
     * @param int $days
     * @return void
     */
    public function incrementSellIn(int $days = 1): void
    {
        $this->item->sellIn += $days;
    }

    /**
     * Decrement sell in by int
     * @param int $days
     * @return void
     */
    public function decrementSellIn(int $days = 1): void
    {
        $this->item->sellIn -= $days;
    }

    /**
     * Increment quality by int
     * @param int $increment
     * @return void
     */
    public function incrementQuality(int $increment = 1): void
    {
        if ($this->item->quality < self::QUALITY_MAX) {
            $this->item->quality += $increment;
        }
    }

    /**
     * Decrement quality by int
     * Doubles if the sell date has passed
     * @param int $decrement
     * @return void
     */
    public function decrementQuality(int $decrement = 1): void
    {
        if ($this->item->quality > self::QUALITY_MIN) {
            if ($this->item->sellIn <= 0) {
                $this->item->quality -= $decrement * 2;
            } else {
                $this->item->quality -= $decrement;
            }
        }

        if ($this->item->quality < 0) {
            $this->item->quality = 0;
        }
    }

    /**
     * Get the item sell in
     * @return int
     */
    public function getSellIn(): int
    {
        return $this->item->sellIn;
    }

    /**
     * Get the item quality
     * @return int
     */
    public function getQuality(): int
    {
        return $this->item->quality;
    }

    /**
     * Set the sell in
     * @param int $sellIn
     * @return void
     */
    public function setSellIn(int $sellIn)
    {
        $this->item->sellIn = $sellIn;
    }

    /**
     * Set the item quality
     * @param int $quality
     * @return void
     */
    public function setQuality(int $quality)
    {
        $this->item->quality = $quality;
    }
}