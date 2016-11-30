<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveWrongNewsCommand  extends ContainerAwareCommand{
    protected function configure()
    {
        $this
            ->setName('news:remove_wr')
            ->setDescription('get new')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('app.remove_wrong_news')->removeWrongNews();
        $output->writeln('done');
    }
}