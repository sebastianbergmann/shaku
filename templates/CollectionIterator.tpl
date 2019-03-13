<?php declare(strict_types=1);
namespace {{namespace}};

final class {{class}}CollectionIterator implements \Countable, \Iterator
{
    /**
     * @var {{class}}[]
     */
    private $items;

    /**
     * @var int
     */
    private $position;

    public function __construct({{class}}Collection $collection)
    {
        $this->items = $collection->toArray();
    }

    public function count(): int
    {
        return \iterator_count($this);
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

    public function current(): {{class}}
    {
        return $this->items[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }
}
