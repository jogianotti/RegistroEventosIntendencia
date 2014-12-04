<?php
// src/Acme/DemoBundle/Command/GreetCommand.php
namespace RegistroEventos\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InsertarDatosPruebaCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('registroeventoscore:crear:datos_prueba')
            ->setDescription('Inserta datos de prueba en la base de datos')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('HOLA');
        
        $userManager = $this->getContainer()->get('fos_user.user_manager');
    }
}