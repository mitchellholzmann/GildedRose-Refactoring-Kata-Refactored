<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\Exceptions\ItemBackstage;
use GildedRose\Items\Exceptions\ItemBrie;
use GildedRose\Items\Exceptions\ItemConjured;
use GildedRose\Items\Exceptions\ItemGeneric;
use GildedRose\Items\Exceptions\ItemSulfuras;
use GildedRose\Items\Item;
use GildedRose\Items\Items;

final class GildedRose
{
    private array $items;

    /**
     * @param Item[] $items
     */
    public function __construct(array $items) {
        $this->setItems($items);
    }

    /**
     * Update items
     * @return $this
     */
    public function updateQuality(): GildedRose
    {
        foreach ($this->getItems() as $item) {
            $item->update();
        }
        return $this;
    }

    /**
     * Set item list
     * @param array $items
     * @return $this
     */
    public function setItems(array $items): GildedRose
    {
        $this->items = $items;
        $this->extendItems();
        return $this;
    }

    /**
     * Get item list
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Place the items in classes that will transform them
     * @return $this
     */
    public function extendItems(): GildedRose
    {
        $extendedItems = array();
        foreach ($this->getItems() as $key => $item) {
            switch ($item->name) {
                case Items::BACKSTAGE->value:
                    $extendedItems[$key] = new ItemBackstage($item);
                    break;
                case Items::BRIE->value:
                    $extendedItems[$key] = new ItemBrie($item);
                    break;
                case Items::CONJURED->value:
                    $extendedItems[$key] = new ItemConjured($item);
                    break;
                case Items::SULFURAS->value:
                    $extendedItems[$key] = new ItemSulfuras($item);
                    break;
                default:
                    $extendedItems[$key] = new ItemGeneric($item);
            }
        }
        $this->items = $extendedItems;
        return $this;
    }
}