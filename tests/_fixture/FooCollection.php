<?php declare(strict_types=1);
namespace vendor;

final class FooCollection implements \IteratorAggregate
{
    /**
     * @var Foo[]
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

    public static function fromList(Foo ...$items): self
    {
        return self::fromArray($items);
    }

    public function add(Foo $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return Foo[]
     */
    public function items(): array
    {
        return $this->items;
    }

    public function getIterator(): FooCollectionIterator
    {
        return new FooCollectionIterator($this);
    }
}
