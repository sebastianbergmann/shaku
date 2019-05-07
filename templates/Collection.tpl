<?php declare(strict_types=1);
namespace {{namespace}};

final class {{class}}Collection implements \Countable, \IteratorAggregate
{
    /**
     * @var {{class}}[]
     */
    private $items = [];

    /**
     * @param {{class}}[] $items
     */
    public static function fromArray(array $items): self
    {
        $collection = new self;

        foreach ($items as $item) {
            $collection->add($item);
        }

        return $collection;
    }

    public static function fromList({{class}} ...$items): self
    {
        return self::fromArray($items);
    }

    {{visibility}} function __construct()
    {
    }

    {{visibility}} function add({{class}} $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return {{class}}[]
     */
    public function toArray(): array
    {
        return $this->items;
    }

    public function getIterator(): {{class}}CollectionIterator
    {
        return new {{class}}CollectionIterator($this);
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function contains({{class}} $item): bool
    {
        foreach ($this->items as $_item) {
            if ($_item === $item) {
                return true;
            }
        }

        return false;
    }{{remove}}
}
