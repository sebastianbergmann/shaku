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
    public function toArray(): array
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

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function contains(Value $item): bool
    {
        foreach ($this->items as $_item) {
            if ($_item === $item) {
                return true;
            }
        }

        return false;
    }

    public function remove(Value $item): bool
    {
        foreach ($this->items as $key => $_item) {
            if ($_item === $item) {
                unset($this->items[$key]);

                return true;
            }
        }

        return false;
    }
}
