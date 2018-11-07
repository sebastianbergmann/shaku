<?php declare(strict_types=1);
namespace vendor;

final class FooCollectionIterator implements \Iterator
{
    /**
     * @var Foo[]
     */
    private $items;

    /**
     * @var int
     */
    private $position;

    public function __construct(FooCollection $collection)
    {
        $this->items = $collection->items();
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return $this->position < \count($this->items);
    }

    public function key(): int
    {
        return $this->position;
    }

    public function current(): Foo
    {
        return $this->items[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }
}
