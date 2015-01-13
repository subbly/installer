<?php

namespace Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class CompileCommand extends Command
{
    protected $installerFile;

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('installer:compile')
            ->setDescription('Compile the Subbly Installer')
        ;
    }

    /**
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $outputFilename = $this->getRootDir().'/build/installer.php.build';
        $finalFilename  = $this->getRootDir().'/build/installer.php';

        $this->output->writeln(' > <comment>Prepare</comment>');
        $this->prepare($outputFilename, $finalFilename);

        $this->output->writeln(' > <comment>Compile views</comment>');
        $this->compileViews(); // Call each views and compile it into a php Class

        $this->output->writeln(' > <comment>Compile classes</comment>');
        $this->compileClasses(); // Get all php Class files into src/ and past the content into the export file

        $this->output->writeln(' > <comment>Cleanup</comment>');
        $this->cleanup();

        $this->output->writeln(' > <comment>Finalize the compilation</comment>');
        $this->finalize($finalFilename);
    }

    /**
     * Prepare files for compilation
     *
     * @param string $outputFilename
     * @param string $finalFilename
     */
    protected function prepare($outputFilename, $finalFilename)
    {
        $this->fs->mkdir($this->getRootDir().'/build/');

        if ($this->fs->exists($outputFilename) || $this->fs->exists($finalFilename)) {
            $continue = $this->dialog->askConfirmation(
                $this->output,
                sprintf('<question>File "%s" or "%s" already exists. Do you want remove thes files to continue?</question>',
                    $outputFilename,
                    $finalFilename
                ),
                false
            );

            if (!$continue) {
                exit;
            }

            $this->fs->remove($outputFilename);
            $this->fs->remove($finalFilename);
        }

        $this->fs->copy(
            $this->getRootDir().'/lib/Resources/installer.php.template',
            $outputFilename
        );

        $file = new \SplFileInfo($this->getRootDir().'/build/installer.php.build');
        $this->installerFile = $file->openFile('a+');
    }

    /**
     * Compile the views
     */
    protected function compileViews()
    {
    }

    /**
     * Compile the php classes
     */
    protected function compileClasses()
    {
        $finder = new Finder();
        $finder
            ->files()
            ->in($this->getRootDir().'/src/')
            ->name('*.php')
            ->notName('*.html.php')
        ;

        foreach ($finder as $file) {
            $this->installerFile->fwrite($this->getPHPFileContents($file));
        }
    }

    /**
     * Cleanup the installer php file
     */
    protected function cleanup()
    {
        // TODO Try to uglify the php
        //       - Remove comments
    }

    /**
     * Finaliaze the compilation
     */
    protected function finalize($outputFilename)
    {
        $file = new \SplFileInfo($this->getRootDir().'/install.php');

        $content = $this->getPHPFileContents($file);
        $content = str_replace('require_once __DIR__.\'/vendor/autoload.php\';', '', $content);

        $this->installerFile->fwrite($content);

        $this->fs->rename($this->installerFile->getRealPath(), $outputFilename);
    }

    /**
     * Get the contents of a PHP file
     *
     * @param \SplFileInfo $file
     *
     * @return string
     */
    protected function getPHPFileContents(\SplFileInfo $file)
    {
        if (!$this->fs->exists($file->getRealPath())) {
            return '';
        }

        $content = @file_get_contents($file->getRealPath());

        // Remove first line "<?php"
        $content = preg_replace("/^.+\n/", '', $content);

        // Remove comments
        $content = preg_replace('!/\*.*?\*/!s', '', $content);
        $content = preg_replace('/\n\s*\n/', "\n", $content);
        $content = preg_replace("/^\s*\/\/.+$/m", '', $content);

        // Remove empty lines
        $content = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $content);

        return $content;
    }
}
