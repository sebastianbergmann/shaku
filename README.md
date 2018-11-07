# Shaku, the Collection Generator

`shaku` can automatically generate type-safe `Collection` and `CollectionIterator` classes.

## Installation

### PHP Archive (PHAR)

The easiest way to obtain Shaku is to download a [PHP Archive (PHAR)](https://php.net/phar) that has all required dependencies of Shaku bundled in a single file:

```
$ wget https://phar.phpunit.de/shaku.phar
```

### Composer

You can add this tool as a local, per-project, development-time dependency to your project using [Composer](https://getcomposer.org/):

```
$ composer require --dev sebastian/shaku
```

You can then invoke it using the `./vendor/bin/shaku` executable.


## Usage

Consider you have a class named `Value` (declared in `src/Value.php`) and need a type-safe `ValueCollection` for objects of this type:

```php
namespace vendor;

final class Value
{
    // ...
}
```

### Generating the `Collection` and `CollectionIterator`

You can use this tool to automatically generate the code for the `ValueCollection` and `ValueCollectionIterator` class like so:

```
$ php shaku.phar --immutable vendor Value src
```

The above results in the generation of the code shown below:

```php
<?php declare(strict_types=1);
namespace vendor;

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

    private function add(Value $item): void
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
```

```php
<?php declare(strict_types=1);
namespace vendor;

final class ValueCollectionIterator implements \Iterator
{
    /**
     * @var Value[]
     */
    private $items;

    /**
     * @var int
     */
    private $position;

    public function __construct(ValueCollection $collection)
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

    public function current(): Value
    {
        return $this->items[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }
}
```

### Using the generated `Collection` and `CollectionIterator`

#### Creating a collection from an array of objects

```php
$values = ValueCollection::fromArray([new Value, new Value]);
```

#### Creating a collection from a list of objects

```php
$values = ValueCollection::fromList(new Value, new Value);
```

#### Creating an empty collection and adding objects to it

```php
$values = new ValueCollection;

$values->add(new Value);
$values->add(new Value);
```

# Shaku?

This tool is named after "Shaku, the Collector", Copyright Blizzard Entertainment, Inc.
