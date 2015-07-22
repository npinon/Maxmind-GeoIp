<?php

namespace Maxmind\Bundle\GeoipBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;

class LoadDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('maxmind:geoip:downloadpackage')
            ->setDescription('Donwload the maxmind geoip database')
            ->addArgument(
                'source',
                InputArgument::REQUIRED,
                'The url source file to download and unzip')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command download and install the maxmind GeoLite2 database

To install the GeoLite2:
<info>php %command.full_name% http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz</info>

EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = $input->getArgument('source');

        $dataDir = $this->getContainer()->getParameter('maxmind_geoip_data_file_path');
        $filename = basename($source);
        $destination = sprintf('%s/%s', $dataDir, $filename);
        $output->writeln(sprintf('Start downloading %s', $source));
        $output->writeln('...');
        if (!copy($source, $destination)) {
            $output->writeln('<error>Error during file download occured</error>');

            return 1;
        }

        $output->writeln('<info>Download completed</info>');
        $output->writeln('Unpack the downloaded file');
        $output->writeln('...');
        system('gunzip -f "'.$destination.'"');
        $extrackedfilename = str_replace('.gz', '', $filename);
        $newfilename = $this->getContainer()->getParameter('maxmind_geoip_data_file_name');
        rename($dataDir.$extrackedfilename, $dataDir.$newfilename);
        $output->writeln('<info>Unpack completed</info>');
    }
}
