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

    private function buscarEventosActivosConEstado($estado)
    {
        return $this->createQueryBuilder('e')
                        ->select('e')
                        ->where('e.rectificacion IS NULL')
                        ->andWhere('e.estado = :estado')->setParameter('estado', $estado)
                        ->orderBy('e.fechaEvento', 'DESC')
                        ->getQuery()
                        ->getResult();
    }

    public function buscarEventosAbiertos()
    {
        return $this->buscarEventosActivosConEstado(TRUE);
    }

    public function buscarEventosCerrados()
    {
        return $this->buscarEventosActivosConEstado(FALSE);
    }

    public function listarDetallesPara($evento)
    {

        $detalles = $this->getEntityManager()->getRepository('RegistroEventosCoreBundle:Detalle')->listarPara($evento);
        
        $eventoAnterior = $this->buscarEventoRectificadoPara($evento);
        while (!is_null($eventoAnterior)) {
            $arrayDetalles = $this->getEntityManager()->getRepository('RegistroEventosCoreBundle:Detalle')->listarPara($eventoAnterior);
            if (!is_null($arrayDetalles)) {
                $detalles = array_merge($detalles, $arrayDetalles);
            }
            $eventoAnterior = $this->buscarEventoRectificadoPara($eventoAnterior);
        }

        return $detalles;
    }

    public function buscarEventoRectificadoPara($evento)
    {
        return $this->createQueryBuilder('e')
                        ->select('e')
                        ->where('e.rectificacion = :evento')
                        ->setParameter('evento', $evento)
                        ->getQuery()
                        ->getOneOrNullResult();
    }

    public function buscarEventosPor($datos)
    {
        $qb = $this->createQueryBuilder('e');
        $qb->select('e')
            ->where('e.rectificacion IS NULL');
                
        if (!is_null($datos['estado']))
            $qb = $qb->andWhere('e.estado = :estado')->setParameter('estado', $datos['estado']);
        
        if (!is_null($datos['usuario']))
            $qb = $qb->andWhere('e.usuario = :usuario')->setParameter('usuario', $datos['usuario']);

        if (!is_null($datos['tipoEvento']))
            $qb = $qb->andWhere('e.tipoEvento = :tipoEvento')->setParameter('tipoEvento', $datos['tipoEvento']);
        
        if (!is_null($datos['fechaDesde']))
            $qb = $qb->andHaving('e.fechaEvento >= :fechaDesde')->setParameter('fechaDesde', $datos['fechaDesde']);
        
        if (!is_null($datos['fechaHasta']))
            $qb = $qb->andHaving('e.fechaEvento <= :fechaHasta')->setParameter('fechaHasta', $datos['fechaHasta']);
        
        if (!is_null($datos['observaciones']))
            $qb = $qb->andWhere ('e.observaciones LIKE :texto')->setParameter('texto', '%'. $datos['observaciones'] .'%');
            
        $qb = $qb->orderBy('e.fechaEvento', 'DESC');

        return $qb->getQuery()->getResult();
    }
    
    public function buscarEventosAbiertosPor($datos) {
        $datos['estado'] = TRUE;
        return $this->buscarEventosPor($datos);
    }
    
    public function buscarEventosCerradosPor($datos) {
        $datos['estado'] = FALSE;
        return $this->buscarEventosPor($datos);
    }

    public function listarRectificacionesDetallesPara($evento)
    {
//        $eventosActivos = $this->createQueryBuilder('e')
//                ->select('e')
//                ->where('e.rectificacion IS NULL')
//                ->orderBy('e.fechaEvento', 'DESC')
//                ->getQuery()
//                ->getResult();
//                
//                
//        foreach($eventosActivos as &$evento) {
//            $evento->setDetalles(
//                $this->getEntityManager()->getRepository('RegistroEventosCoreBundle:Detalle')->listarPara($evento)
//            );
            $eventos[] = $evento;
            $eventoActual = $evento;
            $eventoAnterior = $this->buscarEventoRectificadoPara($evento);
            while (!is_null($eventoAnterior)) {
                $eventoAnterior->setRectificacion($eventoActual);

                $eventoAnterior->setDetalles(
                        $this->getEntityManager()->getRepository('RegistroEventosCoreBundle:Detalle')->listarPara($eventoAnterior)
                );
                
                $eventos[] = $eventoAnterior;
                $eventoActual = $eventoAnterior;
                $eventoAnterior = $this->buscarEventoRectificadoPara($eventoAnterior);
            }
//        }
        
        return $eventos;
    }
}
