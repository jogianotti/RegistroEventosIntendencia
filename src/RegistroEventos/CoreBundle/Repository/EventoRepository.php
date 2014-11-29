<?php

namespace RegistroEventos\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use RegistroEventos\CoreBundle\Repository\DetalleRepository;

/**
 * EventoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventoRepository extends EntityRepository
{
    private function buscarEventosActivosConEstado($estado){
        return $this->createQueryBuilder('e')
                ->select('e')
                ->where('e.rectificacion IS NULL')
                ->andWhere('e.estado = :estado')->setParameter('estado', $estado)
                ->orderBy('e.fechaEvento', 'DESC')
                ->getQuery()
                ->getResult();
    }
    public function buscarEventosAbiertos() {
        return $this->buscarEventosActivosConEstado(TRUE);
    }
    
    public function buscarEventosCerrados() {
        return $this->buscarEventosActivosConEstado(FALSE);
    }
    
    public function listarDetallesPara($evento){
        
        $detalles = $this->getEntityManager()->getRepository('RegistroEventosCoreBundle:Detalle')->listarPara($evento);
        
        $eventoAnterior = $this->buscarEventoRectificadoPara($evento);
        while(!is_null($eventoAnterior)){
            $arrayDetalles = $this->getEntityManager()->getRepository('RegistroEventosCoreBundle:Detalle')->listarPara($eventoAnterior);
            if(!is_null($arrayDetalles)){
                $detalles = array_merge($detalles,$arrayDetalles);
            }
            $eventoAnterior = $this->buscarEventoRectificadoPara($eventoAnterior);
        }
        
        return $detalles;
    }
    
    public function buscarEventoRectificadoPara($evento){
        return $this->createQueryBuilder('e')
                ->select('e')
                ->where('e.rectificacion = :evento')
                ->setParameter('evento', $evento)
                ->getQuery()
                ->getOneOrNullResult();
    }
}
