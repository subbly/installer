<?php

namespace Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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

        $this->prepare($outputFilename, $finalFilename);

        $this->compileViews(); // Call each views and compile it into a php Class

        $this->compileClass(); // Get all php Class files into src/ and past the content into the export file

        $this->finalize($finalFilename);
    }

    /**
     *
     */
    protected function prepare($outputFilename, $finalFilename)
    {
        $this->fs->mkdir($this->getRootDir().'/build/');

        if ($this->fs->exists($outputFilename) || $this->fs->exists($finalFilename)) {

            $continue = $this->dialog->askConfirmation(
                $this->output,
                sprintf('<question>File "%s" or "%s" already exists. Do you want remove it to continue?</question>',
                    $outputFilename,
                    $finalFilename
                ),
                false
            );

            if (!$continue) {
                exit;
            }

            $this->fs->remove($outputFilename);
        }

        $this->fs->copy(
            $this->getRootDir().'/lib/Resources/installer.php.template',
            $outputFilename
        );

        $file = new \SplFileInfo($this->getRootDir().'/build/installer.php.build');
        $this->installerFile = $file->openFile('a+');
    }

    /**
     *
     */
    protected function compileViews()
    {

    }

    /**
     *
     */
    protected function compileClass()
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
     *
     */
    protected function finalize($outputFilename)
    {
        $file = new \SplFileInfo($this->getRootDir().'/install.php');

        $content = $this->getPHPFileContents($file);
        // TODO remove the autload call

        $this->installerFile->fwrite($content);

        $this->fs->rename($this->installerFile->getRealPath(), $outputFilename);
    }

    /**
     *
     */
    protected function getPHPFileContents(\SplFileInfo $file)
    {
        $content = file_get_contents($file->getRealPath());
        $content = preg_replace('/^.+\n/', '', $content);

        return $content;
    }
}
