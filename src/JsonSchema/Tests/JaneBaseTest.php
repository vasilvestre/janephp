<?php

namespace Jane\JsonSchema\tests;

use Jane\JsonSchema\Command\GenerateCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class JaneBaseTest extends TestCase
{
    /**
     * @dataProvider schemaProvider
     */
    public function testRessources($name, SplFileInfo $testDirectory)
    {
        // 1. Generate
        $command = new GenerateCommand();
        $inputArray = new ArrayInput([
            '--config-file' => $testDirectory->getRealPath() . \DIRECTORY_SEPARATOR . '.jane',
        ], $command->getDefinition());

        $command->execute($inputArray, new NullOutput());

        // 2. Compare
        $expectedFinder = new Finder();
        $expectedFinder->in($testDirectory->getRealPath() . \DIRECTORY_SEPARATOR . 'expected');
        $generatedFinder = new Finder();
        $generatedFinder->in($testDirectory->getRealPath() . \DIRECTORY_SEPARATOR . 'generated');
        $generatedData = [];

        $this->assertEquals(\count($expectedFinder), \count($generatedFinder), sprintf('No same number of files for %s', $testDirectory->getRelativePathname()));

        foreach ($generatedFinder as $generatedFile) {
            $generatedData[$generatedFile->getRelativePathname()] = $generatedFile->getRealPath();
        }

        foreach ($expectedFinder as $expectedFile) {
            $this->assertArrayHasKey(
                $expectedFile->getRelativePathname(),
                $generatedData,
                sprintf('File %s does not exist for %s', $expectedFile->getRelativePathname(), $testDirectory->getRelativePathname())
            );

            if ($expectedFile->isFile()) {
                $this->assertEquals(
                    file_get_contents($expectedFile->getRealPath()),
                    file_get_contents($generatedData[$expectedFile->getRelativePathname()]),
                    sprintf('File %s does not have the same content for %s', $expectedFile->getRelativePathname(), $testDirectory->getRelativePathname())
                );
            }
        }
    }

    public function schemaProvider()
    {
        $finder = new Finder();
        $finder->directories()->in(__DIR__ . '/fixtures');
        $finder->depth('< 1');
        $data = [];
        foreach ($finder as $directory) {
            $data[] = [$directory->getFilename(), $directory];
        }

        return $data;
    }
}
