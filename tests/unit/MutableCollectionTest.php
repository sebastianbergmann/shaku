<?php declare(strict_types=1);
/*
 * This file is part of Shaku, the Collection Generator.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Shaku;

use PHPUnit\Framework\TestCase;
use test\mutable\Value;
use test\mutable\ValueCollection;

/**
 * @covers \test\mutable\ValueCollection
 * @covers \test\mutable\ValueCollectionIterator
 *
 * @covers \test\mutable\Value
 */
final class MutableCollectionTest extends TestCase
{
    public function test_is_initially_empty(): void
    {
        $collection = new ValueCollection;

        $this->assertTrue($collection->isEmpty());
        $this->assertSame(0, \count($collection));
    }

    public function test_can_be_created_from_array_of_values(): void
    {
        $values = [new Value, new Value];

        $collection = ValueCollection::fromArray($values);

        $this->assertSame($values, $collection->toArray());
    }

    public function test_can_be_created_from_list_of_values(): void
    {
        $value = new Value;

        $collection = ValueCollection::fromList($value);

        $this->assertSame($value, $collection->toArray()[0]);
    }

    public function test_values_can_be_added(): void
    {
        $values = [new Value, new Value];

        $collection = new ValueCollection;

        $collection->add($values[0]);
        $collection->add($values[1]);

        $this->assertSame($values, $collection->toArray());
    }

    public function test_values_can_be_counted(): void
    {
        $collection = ValueCollection::fromList(new Value, new Value);

        $this->assertCount(2, $collection);
    }

    public function test_values_can_be_iterated(): void
    {
        $value = new Value;

        $collection = ValueCollection::fromList($value);

        foreach ($collection as $key => $_value) {
            $this->assertSame(0, $key);
            $this->assertSame($value, $_value);
        }
    }

    public function test_can_be_queried_whether_it_contains_a_value(): void
    {
        $value = new Value;

        $collection = ValueCollection::fromList($value);

        $this->assertTrue($collection->contains($value));
        $this->assertFalse($collection->contains(new Value));
    }

    public function test_values_can_be_removed(): void
    {
        $value = new Value;

        $collection = ValueCollection::fromList($value);

        $this->assertTrue($collection->remove($value));
        $this->assertFalse($collection->contains($value));
        $this->assertFalse($collection->remove(new Value));
    }
}
