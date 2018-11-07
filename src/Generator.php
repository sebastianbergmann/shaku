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

final class Generator
{
    public function generateCollectionCode(string $namespace, string $className, bool $immutable): string
    {
        return \str_replace(
            '{{visibility}}',
            $immutable ? 'private' : 'public',
            $this->render(__DIR__ . '/../templates/Collection.tpl', $namespace, $className)
        );
    }

    public function generateCollectionIteratorCode(string $namespace, string $className): string
    {
        return $this->render(__DIR__ . '/../templates/CollectionIterator.tpl', $namespace, $className);
    }

    private function render(string $template, string $namespace, string $className): string
    {
        return \str_replace(
            [
                '{{namespace}}',
                '{{class}}',
            ],
            [
                $namespace,
                $className,
            ],
            \file_get_contents($template)
        );
    }
}
