<?php
// src/Acme/DemoBundle/Command/GreetCommand.php
namespace RegistroEventos\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class crearAdminInicialCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('registro_eventos_core:crear:admin_inicial')
            ->setDescription('Crea el primer usuario administrador para iniciar en el sistema')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userManager = $this->getContainer()->get('fos_user.user_manager');
        
        $usuario = $userManager->findUserByUsername('admin');
        if(!$usuario){
            $usuario = $userManager->createUser();
        }
        $usuario->setUsername('admin');
        $usuario->setPlainPassword('admin');
        $usuario->setNombre('Admin');
        $usuario->setRoles(array('ROLE_ADMINISTRADOR'));
        $usuario->setEnabled(true);
        $usuario->setBaja(false);

        $userManager->updateUser($usuario);
        
        $output->writeln('Se creó usuario administrador inicial.');
        $output->writeln('Usuario: admin');
        $output->writeln('Clave: admin');
    }
}