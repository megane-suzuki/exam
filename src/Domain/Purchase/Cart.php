<?php

namespace App\Domain\Purchase;

use App\Domain\Purchase\Exception\EmptyCartException;

class Cart
{
    /**
     * @var Record[]
     */
    protected $elements = [];

    /**
     * Cart constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @param Record $element
     */
    public function add(Record $element)
    {
        $this->elements[] = $element;
    }

    /**
     * @return string
     */
    public function show(): string
    {
        try {
            return $this->issueDetail();
        } catch (EmptyCartException $e) {
            return 'お客様のショッピングカートに商品はありません。';
        }
    }

    /**
     * @return string
     * @throws EmptyCartException
     */
    private function issueDetail(): string
    {
        if ($this->totalQuantity() === 0) {
            throw new EmptyCartException();
        }

        return $this->issueRecords().$this->issueSubtotal();
    }

    /**
     * @return string
     */
    private function issueSubtotal(): string
    {
        return sprintf('小計 (%d 点): \\%d', $this->totalQuantity(), $this->subtotal());
    }

    /**
     * @return string
     */
    private function issueRecords(): string
    {
        return implode('', array_map(function (Record $item) {
            return $item->issueDetail();
        }, $this->elements));
    }

    /**
     * @return int
     */
    private function subtotal(): int
    {
        return array_reduce($this->elements, function (int $carry, Record $item) {
            $carry += $item->product()->price() * $item->quantity();

            return $carry;
        }, 0);
    }

    /**
     * @return int
     */
    private function totalQuantity(): int
    {
        return array_reduce($this->elements, function (int $carry, Record $item) {
            $carry += $item->quantity();

            return $carry;
        }, 0);
    }
}
