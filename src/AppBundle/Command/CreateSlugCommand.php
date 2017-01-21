<?php
namespace AppBundle\Command;

use AppBundle\Entity\News;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSlugCommand  extends ContainerAwareCommand{
    protected function configure()
    {
        $this
            ->setName('news:create-slug')
            ->setDescription('additional services')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $limit = 20;
        $offset = 0;
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $translator = $this->getContainer()->get('app.transliterator');
        while (true) {
            $news = $em->getRepository(News::class)->getNewsWithoutSlug($limit, $offset);
            if (count($news)) {
                foreach ($news as $n) {
                    $slug = $translator->getSlug($n->getStrForSlug());
                    $n->setSlug($slug);
                    $em->persist($n);
                }
                $em->flush();
            } else {
                break;
            }
            $offset += count($news);
        }

        $output->writeln('done');
    }
}