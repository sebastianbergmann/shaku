<?php declare(strict_types=1);
/*
 * This file is part of Shaku, the Collection Generator.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Shaku\CLI;

use SebastianBergmann\Shaku\Generator;
use Symfony\Component\Console\Command\Command as AbstractCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 */
final class Command extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('shaku');

        $this->addArgument('namespace', InputArgument::REQUIRED, 'Namespace of the class for which Collection and CollectionIterator should be generated');
        $this->addArgument('className', InputArgument::REQUIRED, 'Name of the class for which Collection and CollectionIterator should be generated');
        $this->addArgument('directory', InputArgument::REQUIRED, 'Directory in which the source files for Collection and CollectionIterator should be created');
        $this->addOption('immutable', null, null, 'Make the Collection object immutable');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $namespace        = $input->getArgument('namespace');
        $className        = $input->getArgument('className');
        $directory        = \realpath($input->getArgument('directory'));
        $collectionTarget = $directory . \DIRECTORY_SEPARATOR . $className . 'Collection.php';
        $iteratorTarget   = $directory . \DIRECTORY_SEPARATOR . $className . 'CollectionIterator.php';
        $immutable        = $input->getOption('immutable');

        $generator = new Generator;

        \file_put_contents(
            $collectionTarget,
            $generator->generateCollectionCode($namespace, $className, $immutable),
            \LOCK_EX
        );

        \file_put_contents(
            $iteratorTarget,
            $generator->generateCollectionIteratorCode($namespace, $className),
            \LOCK_EX
        );

        $output->writeln(
            \sprintf(
                'Generated code for "%s" and "%s" in "%s" and "%s", respectively.',
                $className . 'Collection',
                $className . 'CollectionIterator',
                $directory . \DIRECTORY_SEPARATOR . 'Collection.php',
                $directory . \DIRECTORY_SEPARATOR . 'CollectionIterator.php'
            )
        );
    }
}
