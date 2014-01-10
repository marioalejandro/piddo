<?php

namespace Piddo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\MotorBundle\Entity\Marca;
use Piddo\MotorBundle\Entity\Modelo;
use Piddo\MotorBundle\Entity\Serie;
use Piddo\AdminBundle\Form\MarcaType;
use Piddo\AdminBundle\Form\ModeloType;
use Piddo\AdminBundle\Form\SerieType;
use Piddo\AdminBundle\Form\PiezaType;
use Piddo\AdminBundle\Form\GrupoPiezaType;
use Piddo\AdminBundle\Form\SeriePiezasType;
use Piddo\TallerBundle\Entity\ColRectificado;
use Piddo\AdminBundle\Form\SerieRectType;
use Piddo\AdminBundle\Form\AgregarRepuestoType;
use Piddo\RepuestoBundle\Entity\Repuesto;
use Piddo\PresupuestoBundle\Entity\Casillero;


class DefaultController extends Controller
{
    public function portadaGerenciaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $presupuestos = $em->getRepository('PresupuestoBundle:Presupuesto')->findAll();
        return $this->render('AdminBundle:Default:portadaGerencia.html.twig', 
            array(
                'presupuestos' => $presupuestos,
            ));
    }

    public function marcasAction()
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        $marca = new Marca();
        $formulario = $this->createForm(new MarcaType(), $marca);
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            $em->persist($marca);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'La marca '.$marca->getNombre().' ha sido registrada correctamente');
            return $this->redirect($this->generateUrl('admin_marcas'));
        }
        return $this->render('AdminBundle:Default:marcas.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'marcas' => $em->getRepository('MotorBundle:Marca')->findMarcas()
                ));
      }
      public function borrarMarcaAction($marca)
      {
          $em = $this->getDoctrine()->getManager();
          $em->getRepository('MotorBundle:Marca')->deleteMarca($marca);
            $this->get('session')->getFlashBag()->add('info', 'La marca ha sido borrada');
          return $this->redirect($this->generateUrl('admin_marcas'));
      }
      public function borrarModeloAction($marca, $modelo)
      {
          $em = $this->getDoctrine()->getManager();
          $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('id' => $marca));
 
          $em->getRepository('MotorBundle:Modelo')->deleteModelo($modelo);
            $this->get('session')->getFlashBag()->add('info', 'El modelo ha sido borrado');
          return $this->redirect($this->generateUrl('admin_modelos',array('marca'=> $objetoMarca->getSlug())));
      }
    public function borrarSerieAction($marca, $modelo,$serie)
    {
        $em = $this->getDoctrine()->getManager();
        $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('id' => $marca));
        $objetoModelo = $em->getRepository('MotorBundle:Modelo')->findOneBy(array('id' => $modelo));
        
        $em->getRepository('MotorBundle:Serie')->deleteSerie($serie);
        $this->get('session')->getFlashBag()->add('info', 'La serie ha sido borrada');
        return $this->redirect($this->generateUrl('admin_series',
              array(
                  'marca'=> $objetoMarca->getSlug(), 
                  'modelo' =>$objetoModelo->getSlug()
              )));
      }

//--------------Modelos acción---------------------
      public function modelosAction($marca)
       {
           
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('slug' => $marca));
        
        $modelo = new Modelo();
        $formulario = $this->createForm(new ModeloType(), $modelo);
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            $modelo->setMarca($objetoMarca);
            
            $em->persist($modelo);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'El Modelo '.$modelo->getNombre().' ha sido registrado correctamente');

            return $this->redirect($this->generateUrl('admin_modelos',array('marca'=> $marca)));
        }
        return $this->render('AdminBundle:Default:modelos.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'modelos' => $em->getRepository('MotorBundle:Modelo')->findModelos($objetoMarca->getID()),
                    'marca' => $objetoMarca
                ));
      }
       
    public function seriesAction($marca, $modelo)
    {
           
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('slug' => $marca));
        $objetoModelo = $em->getRepository('MotorBundle:Modelo')->findOneBy(array('slug'=>$modelo, 'marca'=>$objetoMarca->getId()));
        
        $serie = new Serie();
        $serie->setModelo($objetoModelo);
        $formulario = $this->createForm(new SerieType(), $serie);
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            
            $em->persist($serie);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'La serie '.$serie->getNombre().' ha sido registrada correctamente');

            return $this->redirect($this->generateUrl('admin_series',
                    array(
                        'marca'=> $marca, 
                        'modelo' =>$objetoModelo->getSlug()
                    )));
        }
        return $this->render('AdminBundle:Default:series.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'series' => $em->getRepository('MotorBundle:Serie')->findSeries($objetoModelo),
                    'marca' => $objetoMarca,
                    'modelo' => $objetoModelo
                ));
      }
      
    public function piezasAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        
        
        $grupoPieza = new GrupoPieza();
        $formulario2 = $this->createForm(new GrupoPiezaType(), $grupoPieza);
        $formulario2->handleRequest($peticion);
        if($formulario2->isValid()){
            $em->persist($grupoPieza);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'El Grupo '.$grupoPieza->getNombre().' ha sido registrado correctamente');
            return $this->redirect($this->generateUrl('admin_piezas'));
        }
        
        
        $pieza = new Pieza();
        $formulario = $this->createForm(new PiezaType(), $pieza);
        $formulario->handleRequest($peticion);
        if($formulario->isValid()){
            $em->persist($pieza);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'La Pieza '.$pieza->getNombre().' ha sido registrado correctamente');
            return $this->redirect($this->generateUrl('admin_piezas'));
        }
        
        return $this->render('AdminBundle:Default:piezas.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'formulario2' => $formulario2->createView(),
                    'gruposPieza' => $em->getRepository('MotorBundle:GrupoPieza')->findAll()
                ));
    }
    public function listaPiezasAction($grupo)
            {
                $em = $this->getDoctrine()->getManager();
                $piezas = $em->getRepository('MotorBundle:Pieza')->findBy(array('grupoPieza' => $grupo));
                return $this->render('AdminBundle:Default:listaPiezas.html.twig', 
                    array(
                        'piezas' => $piezas
                    ));
            }
            
    public function ColPiezasAction($marca, $modelo, $serie)
        { 
        
        
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        
        
        //Datos desde BD
        $piezas = $em->getRepository('MotorBundle:Pieza')->findAll();
        $gruposPieza = $em->getRepository('MotorBundle:GrupoPieza')->findAll();
        $oSerie = $em->getRepository('MotorBundle:Serie')->findOneBy(array('slug' => $serie));
        //$piezasSerie = $em->getRepository('MotorBundle:ColPiezas')->findBy(array('serie' => $oSerie->getID()));
        $piezasSerie = $oSerie->getPiezasDisponibles();
        
        
        /**************************************************************
         * NUEVO FORMULARIO CON OBJETOS
         **************************************************************/
        //1.- Creacion de objeto serie (creado)
        //2.- Creacion de los objetos ColPiezas
        
        $i=0;
        //Recorremos los grupos
       while($i < sizeof($gruposPieza))
            {
            $piezas = $em->getRepository('MotorBundle:Pieza')->findBy(array('grupoPieza' => $gruposPieza[$i]->getID()));
            $j=0;
            //Recorremos las piezas por grupo
            while($j<sizeof($piezas))
            {

                //Vemos si el motor ya tiene agregada esa pieza
                //para cargar el valor de maximo
                $k=0;
                $nuevo = true;
                while($k < sizeof($piezasSerie))
                    {
                    if($piezasSerie[$k]->getPieza() == $piezas[$j])
                        {
                        $nuevo = false;
                        }
                    $k++;
                    }
                    if($nuevo)
                        {
                        $cp = new ColPiezas();
                        $cp->setMaximo(0);
                        $cp->setPieza($piezas[$j]);
                        $cp->setSerie($oSerie);
                        $oSerie->getPiezasDisponibles()->add($cp);
                        }
                    
                $j++;
            }
            $i++;
            }
        
        //3.- Agregar los ColPiezas a la serie(hecho)
        //4.- Creacion de formulario
        $form2 = $this->createForm(new SeriePiezasType(), $oSerie);
        
        $form2->handleRequest($peticion);
        
        if($form2->isValid()){
            $em->persist($oSerie);
            $em->flush();
            
            $mensaje ='La serie se ha modeificado correctamente';

           $this->get('session')->getFlashBag()->add('info', $mensaje);


            //return $this->redirect($this->generateUrl('admin_clientes'));
        
        }/**/
        /**************************************************************
         * FIN NUEVO FORMULARIO CON OBJETOS
         **************************************************************/
        
        // creacion Formulario
        /*
        
        $defaultData = array();
        $builder = $this->createFormBuilder($defaultData);
        $gp = array();        
        
        
        $i=0;
        while($i < sizeof($gruposPieza))
            {
            $piezas = $em->getRepository('MotorBundle:Pieza')->findBy(array('grupoPieza' => $gruposPieza[$i]->getID()));
            $j=0;
            while($j<sizeof($piezas))
            {
                //Vemos si el motor ya tiene agregada esa pieza
                //para cargar el valor de maximo
                $k=0;
                $maximo = 0;
                while($k < sizeof($piezasSerie))
                    {
                    if($piezasSerie[$k]->getPieza() == $piezas[$j])
                        {
                            $maximo = $piezasSerie[$k]->getMaximo();
                        }
                    $k++;
                    }
                //Creamos el input en el formulario
                $builder->add($piezas[$j]->getId(),'number',array(
                    'label' => $piezas[$j]->getNombre(),
                    'data' => $maximo,
                    'invalid_message' => 'Ingrese solo números'
                ));
                //$gp->add($piezas[$j]->getGrupo());
                $num_piezas = sizeof($piezas[$j]->getGrupoPieza()->getPiezas());
                array_push($gp,array(
                    'nombre' => $piezas[$j]->getGrupoPieza()->getNombre(),
                    'numero' => $num_piezas,
                    'pieza' => $piezas[$j]->getNombre()
                        ));
                $j++;
            }
            $i++;
            }
         $form= $builder->getForm();
         
         $form->handleRequest($peticion);/**/
 
      /*      if ($form->isValid()) {
                $data = $form->getData();
                $i = 0;
                while($i < sizeof($gruposPieza))
                    {
                    $piezas = $em->getRepository('MotorBundle:Pieza')->findBy(array('grupoPieza' => $gruposPieza[$i]->getID()));
                    $j=0;
                     while($j<sizeof($piezas))
                         {
                         //print_r($data[$piezas[$j]->getNombre()]);
                         if($data[$piezas[$j]->getId()]>0)
                         {
                            $colPieza = new ColPiezas();
                            $k=0;
                            $maximo = 0;
                            while($k < sizeof($piezasSerie))
                            {
                                if($piezasSerie[$k]->getPieza() == $piezas[$j])
                                    {
                                    //print_r($piezasSerie[$k]->getID());
                                        $colPieza = $em->getRepository('MotorBundle:ColPiezas')->findOneBy(array('id' => $piezasSerie[$k]->getID()));
                                    }
                                $k++;
                            }
                            $colPieza->setMaximo($data[$piezas[$j]->getId()]);
                            $colPieza->setPieza($piezas[$j]);
                            $colPieza->setSerie($oSerie);
                            $em->persist($colPieza);
                         }
                         $j++;
                         }
                    $i++;
                    }
                    $em->flush();
                //print_r($data);
            }/**/
        return $this->render('AdminBundle:Default:colPiezas.html.twig', 
                array(
                    'form' => $form2->createView(),
                    'gruposPieza' => $gruposPieza,
                    'marca' => $marca,
                    'modelo' => $modelo,
                    'serie' => $serie,
                    //'grupos' =>$gp
                ));
        }
        
        public function perfilRectificadoAction($marca, $modelo, $serie)
        { 
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        
        
        //Datos desde BD
        $rectificados = $em->getRepository('TallerBundle:Rectificado')->findAll();
        $gruposRectificado = $em->getRepository('TallerBundle:GrupoRectificado')->findAll();
        $oSerie = $em->getRepository('MotorBundle:Serie')->findOneBy(array('slug' => $serie));
        $rectSerie = $oSerie->getRectDisponibles();
        
        
        /**************************************************************
         * NUEVO FORMULARIO CON OBJETOS
         **************************************************************/
        //1.- Creacion de objeto serie (creado)
        //2.- Creacion de los objetos ColRectificado
        
        $i=0;
        //Recorremos los grupos
       while($i < sizeof($gruposRectificado))
            {
            $rect = $em->getRepository('TallerBundle:Rectificado')->findBy(array('grupoRectificado' => $gruposRectificado[$i]->getID()));
            $j=0;
            //Recorremos las piezas por grupo
            while($j<sizeof($rect))
            {

                //Vemos si el motor ya tiene agregada esa pieza
                //para cargar el valor de maximo
                $k=0;
                $nuevo = true;
                while($k < sizeof($rectSerie))
                    {
                    if($rectSerie[$k]->getRectificado() == $rect[$j])
                        {
                        $nuevo = false;
                        }
                    $k++;
                    }
                    if($nuevo)
                        {
                        $cr = new ColRectificado();
                        $cr->setCantidad(0);
                        $cr->setRectificado($rect[$j]);
                        $cr->setSerie($oSerie);
                        $oSerie->getRectDisponibles()->add($cr);
                        }
                    
                $j++;
            }
            $i++;
            }
        
        //3.- Agregar los ColPiezas a la serie(hecho)
        //4.- Creacion de formulario
        $form2 = $this->createForm(new SerieRectType(), $oSerie);
        
        $form2->handleRequest($peticion);
        
        if($form2->isValid()){
            $em->persist($oSerie);
            $em->flush();
            
            $mensaje ='La serie se ha modeificado correctamente';

           $this->get('session')->getFlashBag()->add('info', $mensaje);


            //return $this->redirect($this->generateUrl('admin_clientes'));
        
        }/**/
        /**************************************************************
         * FIN NUEVO FORMULARIO CON OBJETOS
         **************************************************************/
   
        return $this->render('AdminBundle:Default:rectificados2.html.twig', 
                array(
                    'form' => $form2->createView(),
                    'gruposPieza' => $gruposRectificado,
                    'marca' => $marca,
                    'modelo' => $modelo,
                    'serie' => $serie,
                    //'grupos' =>$gp
                ));
        }

        /************************
         * Agregar Repuestos
         ************************/
        public function agregarRepuestosAction ()
        {
            $peticion = $this->getRequest();
            $em = $this->getDoctrine()->getManager();
            
            $repuesto = new Repuesto();
            
            $formulario = $this->createForm(new AgregarRepuestoType(), $repuesto);
            $formulario->handleRequest($peticion);
            
            if($formulario->isValid()){
                $em->persist($repuesto);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'El Repuesto '.$repuesto.' ha sido registrado correctamente');
                return $this->redirect($this->generateUrl('agregar_repuestos'));
            }
            
            return $this->render('AdminBundle:Default:agregarRepuestos.html.twig',
                    array(
                        'formulario' => $formulario->createView(),
                        'repuestos' => $em->getRepository('RepuestoBundle:Repuesto')->findAll()
                    ));
        }
        
        /************
         * Casilleros
         */
        
        public function casillerosAction($param) 
        {
            $peticion = $this->getRequest();
            $em = $this->getDoctrine()->getManager();
            
            //$repuesto = new ();
            
            $formulario = $this->createForm(new AgregarRepuestoType(), $repuesto);
            $formulario->handleRequest($peticion);
            
            if($formulario->isValid()){
                $em->persist($repuesto);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'El Repuesto '.$repuesto.' ha sido registrado correctamente');
                return $this->redirect($this->generateUrl('agregar_repuestos'));
            }
            
            return $this->render('AdminBundle:Default:agregarRepuestos.html.twig',
                    array(
                        'formulario' => $formulario->createView(),
                        'repuestos' => $em->getRepository('RepuestoBundle:Repuesto')->findAll()
                    ));
        }
}
