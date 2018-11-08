<?php declare(strict_types=1);
namespace test\mutable;

final class ValueCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var Value[]
     */
    private $items = [];

    public static function fromArray(array $items): self
    {
        $collection = new self;

        foreach ($items as $item) {
            $collection->add($item);
        }

        return $collection;
    }

    public static function fromList(Value ...$items): self
    {
        return self::fromArray($items);
    }

    public function __construct()
    {
    }

    public function add(Value $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return Value[]
     */
    public function items(): array
    {
        return $this->items;
    }

    public function getIterator(): ValueCollectionIterator
    {
        return new ValueCollectionIterator($this);
    }

    public function count(): int
    {
        return \count($this->items);
    }
}
