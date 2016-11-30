<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateNewsCommand  extends ContainerAwareCommand{
    protected function configure()
    {
        $this
            ->setName('news:update')
            ->setDescription('get new')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('app.news_downloader')->requestForNews();
        $output->writeln('done');
    }
}