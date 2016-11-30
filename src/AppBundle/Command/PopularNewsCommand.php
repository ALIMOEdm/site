<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PopularNewsCommand   extends ContainerAwareCommand{
    protected function configure()
    {
        $this
            ->setName('news:popular')
            ->setDescription('additional services')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('app.popular_news')->formPopularNews();
        $output->writeln('done');
    }
}