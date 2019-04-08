<?php

namespace App\Domain\Product;

class Product
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $price;

    /**
     * Product constructor.
     *
     * @param string $title
     * @param int    $price
     */
    public function __construct(string $title, int $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function price(): int
    {
        return $this->price;
    }
}
