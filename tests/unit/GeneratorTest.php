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

/**
 * @covers \SebastianBergmann\Shaku\Generator
 */
final class GeneratorTest extends TestCase
{
    /**
     * @var Generator
     */
    private $generator;

    protected function setUp(): void
    {
        $this->generator = new Generator;
    }

    public function test_Collection_class_is_generated_correctly(): void
    {
        $this->assertStringEqualsFile(
            __DIR__ . '/../_fixture/ValueCollection.php',
            $this->generator->generateCollectionCode('vendor', 'Value', false)
        );
    }

    public function test_immutable_Collection_class_is_generated_correctly(): void
    {
        $this->assertStringEqualsFile(
            __DIR__ . '/../_fixture/ImmutableValueCollection.php',
            $this->generator->generateCollectionCode('vendor', 'Value', true)
        );
    }

    public function test_CollectionIterator_class_is_generated_correctly(): void
    {
        $this->assertStringEqualsFile(
            __DIR__ . '/../_fixture/ValueCollectionIterator.php',
            $this->generator->generateCollectionIteratorCode('vendor', 'Value')
        );
    }
}
