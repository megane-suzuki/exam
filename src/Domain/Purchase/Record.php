<?php

namespace App\Domain\Purchase;

use App\Domain\Product\Product;

class Record
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * Record constructor.
     *
     * @param Product $product
     * @param int     $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return Product
     */
    public function product(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function quantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function issueDetail(): string
    {
        $title = $this->product()->title();
        $price = $this->product()->price();

        return sprintf("%s\t%d\t%d", $title, $price, $this->quantity) . PHP_EOL;
    }
}
