<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Comando que envía cada día un email a todos los usuarios que lo
 * permiten con la información de la oferta del día en su ciudad.
 */
class EmailOfertaDelDiaCommand extends ContainerAwareCommand
{

    private $host;
    private $accion;
    /** @var ContainerInterface */
    private $contenedor;
    /** @var ObjectManager */
    private $em;
    /** @var SymfonyStyle */
    private $io;

    protected function configure()
    {
        $this
            ->setName('app:email:oferta-del-dia')
            ->setDefinition(array(
                new InputOption('accion', false, InputOption::VALUE_OPTIONAL, 'Indica si los emails realmente se envían a sus destinatarios o sólo se generan'),
            ))
            ->setDescription('Genera y envía a cada usuario el email con la oferta diaria')
            ->setHelp(<<<EOT
El comando <info>email:oferta-del-dia</info> genera y envía un email con la
oferta del día de la ciudad en la que se ha apuntado el usuario. También tiene
en cuenta si el usuario permite el envío o no de publicidad.
EOT
            );
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->accion = $input->getOption('accion');
        $this->contenedor = $this->getContainer();
        $this->em = $this->contenedor->get('doctrine')->getManager();
        $this->io = new SymfonyStyle($input, $output);
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io->title('Mailing - Oferta del día');

        $destinatarios = $this->em->getRepository('AppBundle:Usuario')->findBy(array('permiteEmail' => true));
        $this->io->text(sprintf('Se van a enviar <info>%d</info> emails', count($destinatarios)));

    }

    /**
     * Busca la 'oferta del día' en todas las ciudades de la aplicación.
     *
     * @return array
     */
    private function findOfertasDelDia()
    {
        $ofertas = array();
        $ciudades = $this->em->getRepository('AppBundle:Ciudad')->findAll();
        foreach ($ciudades as $ciudad) {
            $id = $ciudad->getId();
            $slug = $ciudad->getSlug();
            $ofertas[$id] = $this->em->getRepository('AppBundle:Oferta')->findOfertaDelDiaSiguiente($slug);
        }
        return $ofertas;
    }




}