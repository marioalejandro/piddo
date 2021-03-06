<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                if (0 === strpos($pathinfo, '/_profiler/i')) {
                    // _profiler_info
                    if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                    }

                    // _profiler_import
                    if ($pathinfo === '/_profiler/import') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:importAction',  '_route' => '_profiler_import',);
                    }

                }

                // _profiler_export
                if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]++)\\.txt$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_export')), array (  '_controller' => 'web_profiler.controller.profiler:exportAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/componente')) {
            // componente_universo
            if ($pathinfo === '/componente/universo') {
                return array (  '_controller' => 'Piddo\\ComponenteBundle\\Controller\\ComponenteController::universoAction',  '_route' => 'componente_universo',);
            }

            // componente_perfil
            if (preg_match('#^/componente/(?P<serie>[^/]++)/perfil$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'componente_perfil')), array (  '_controller' => 'Piddo\\ComponenteBundle\\Controller\\ComponenteController::perfilAction',));
            }

        }

        // recepcion_portada
        if (rtrim($pathinfo, '/') === '/recepcion') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'recepcion_portada');
            }

            return array (  '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::portadaRecepcionAction',  '_route' => 'recepcion_portada',);
        }

        if (0 === strpos($pathinfo, '/crea')) {
            // recepcion_crear_presupuesto
            if (rtrim($pathinfo, '/') === '/creauno/presupuesto') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'recepcion_crear_presupuesto');
                }

                return array (  '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::crearPresupuestoAction',  '_route' => 'recepcion_crear_presupuesto',);
            }

            // recepcion_crear_motor
            if ($pathinfo === '/crea/motor') {
                return array (  '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::crearMotorAction',  '_route' => 'recepcion_crear_motor',);
            }

            // recepcion_crear_motor_modelo
            if (preg_match('#^/crea/(?P<marca>[^/]++)/modelo$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'recepcion_crear_motor_modelo')), array (  '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::crearMotorModeloAction',));
            }

            // recepcion_crear_motor_modelo_serie
            if (preg_match('#^/crea/(?P<marca>[^/]++)/(?P<modelo>[^/]++)/serie$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'recepcion_crear_motor_modelo_serie')), array (  '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::crearMotorModeloSerieAction',));
            }

        }

        // recepcion_agregar_cliente
        if (rtrim($pathinfo, '/') === '/agregar/cliente') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'recepcion_agregar_cliente');
            }

            return array (  '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::agregarClienteAction',  '_route' => 'recepcion_agregar_cliente',);
        }

        if (0 === strpos($pathinfo, '/repuesto')) {
            // repuesto_portada
            if ($pathinfo === '/repuesto') {
                return array (  '_controller' => 'Piddo\\RepuestoBundle\\Controller\\DefaultController::repuestoAction',  '_route' => 'repuesto_portada',);
            }

            // repuesto_lista_solicitudes
            if ($pathinfo === '/repuesto/solicitudes') {
                return array (  '_controller' => 'Piddo\\RepuestoBundle\\Controller\\DefaultController::listaSolicitudesAction',  '_route' => 'repuesto_lista_solicitudes',);
            }

            // repuesto_presupuestos
            if ($pathinfo === '/repuesto/presupuestos') {
                return array (  '_controller' => 'Piddo\\RepuestoBundle\\Controller\\DefaultController::listaPresupuestosAction',  '_route' => 'repuesto_presupuestos',);
            }

            // repuesto_lista
            if ($pathinfo === '/repuesto/lista') {
                return array (  '_controller' => 'Piddo\\RepuestoBundle\\Controller\\DefaultController::listaAction',  '_route' => 'repuesto_lista',);
            }

        }

        // nuevo_presupuesto
        if (0 === strpos($pathinfo, '/nuevo-presupuesto') && preg_match('#^/nuevo\\-presupuesto(?:/(?P<presupuesto>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nuevo_presupuesto')), array (  '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::nuevoAction',  'presupuesto' => NULL,));
        }

        if (0 === strpos($pathinfo, '/presupuesto')) {
            // presupuesto_recepcion
            if (0 === strpos($pathinfo, '/presupuesto/recepcion') && preg_match('#^/presupuesto/recepcion/(?P<presupuesto>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'presupuesto_recepcion')), array (  '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::recepcionAction',));
            }

            // presupuesto_trabajos
            if (0 === strpos($pathinfo, '/presupuesto/trabajos') && preg_match('#^/presupuesto/trabajos/(?P<presupuesto>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'presupuesto_trabajos')), array (  '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::trabajosAction',));
            }

            // presupuesto_repuestos
            if (0 === strpos($pathinfo, '/presupuesto/repuestos') && preg_match('#^/presupuesto/repuestos/(?P<presupuesto>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'presupuesto_repuestos')), array (  '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::repuestosAction',));
            }

            // presupuesto_final
            if (0 === strpos($pathinfo, '/presupuesto/final') && preg_match('#^/presupuesto/final/(?P<presupuesto>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'presupuesto_final')), array (  '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::finalAction',));
            }

        }

        // admin_clientes
        if ($pathinfo === '/registro-cliente') {
            return array (  '_controller' => 'Piddo\\ClienteBundle\\Controller\\DefaultController::registroAction',  '_route' => 'admin_clientes',);
        }

        if (0 === strpos($pathinfo, '/taller')) {
            // rectificado_universo
            if ($pathinfo === '/taller/universo') {
                return array (  '_controller' => 'Piddo\\TallerBundle\\Controller\\RectificadosController::universoAction',  '_route' => 'rectificado_universo',);
            }

            // rectificado_perfil
            if (preg_match('#^/taller/(?P<serie>[^/]++)/perfil$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'rectificado_perfil')), array (  '_controller' => 'Piddo\\TallerBundle\\Controller\\RectificadosController::perfilAction',));
            }

        }

        if (0 === strpos($pathinfo, '/administracion')) {
            // portada_gerencia
            if (0 === strpos($pathinfo, '/administracion/portada') && preg_match('#^/administracion/portada(?:/(?P<index>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'portada_gerencia')), array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::portadaGerenciaAction',  'index' => 0,));
            }

            if (0 === strpos($pathinfo, '/administracion/marcas')) {
                // admin_marcas
                if ($pathinfo === '/administracion/marcas') {
                    return array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::marcasAction',  '_route' => 'admin_marcas',);
                }

                // borrar_marca
                if (0 === strpos($pathinfo, '/administracion/marcas/borrar') && preg_match('#^/administracion/marcas/borrar\\-(?P<marca>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'borrar_marca')), array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::borrarMarcaAction',));
                }

            }

            // admin_modelos
            if (preg_match('#^/administracion/(?P<marca>[^/]++)/modelos$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_modelos')), array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::modelosAction',));
            }

            // borrar_modelo
            if (preg_match('#^/administracion/(?P<marca>[^/]++)/borrar\\-(?P<modelo>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'borrar_modelo')), array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::borrarModeloAction',));
            }

            // admin_series
            if (preg_match('#^/administracion/(?P<marca>[^/]++)/(?P<modelo>[^/]++)/series$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_series')), array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::seriesAction',));
            }

            // borrar_serie
            if (preg_match('#^/administracion/(?P<marca>[^/]++)/(?P<modelo>[^/]++)/borrar\\-(?P<serie>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'borrar_serie')), array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::borrarSerieAction',));
            }

            // serie_col_piezas
            if (preg_match('#^/administracion/(?P<marca>[^/]++)/(?P<modelo>[^/]++)/(?P<serie>[^/]++)/piezas$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'serie_col_piezas')), array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::ColPiezasAction',));
            }

            // agregar_repuestos
            if ($pathinfo === '/administracion/repuestos') {
                return array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::agregarRepuestosAction',  '_route' => 'agregar_repuestos',);
            }

        }

        if (0 === strpos($pathinfo, '/precios')) {
            // precios
            if ($pathinfo === '/precios') {
                return array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\PreciosController::preciosAction',  '_route' => 'precios',);
            }

            // tipo
            if (preg_match('#^/precios/(?P<tipo>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'tipo')), array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\PreciosController::tiposAction',));
            }

        }

        // admin_casilleros
        if ($pathinfo === '/administracion/casilleros') {
            return array (  '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::casillerosAction',  '_route' => 'admin_casilleros',);
        }

        // usuario_registro
        if ($pathinfo === '/registro') {
            return array (  '_controller' => 'Piddo\\UsuarioBundle\\Controller\\DefaultController::registroAction',  '_route' => 'usuario_registro',);
        }

        if (0 === strpos($pathinfo, '/log')) {
            // usuario_logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'usuario_logout');
            }

            if (0 === strpos($pathinfo, '/login')) {
                // usuario_login_check
                if ($pathinfo === '/login_check') {
                    return array('_route' => 'usuario_login_check');
                }

                // usuario_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Piddo\\UsuarioBundle\\Controller\\DefaultController::loginAction',  '_route' => 'usuario_login',);
                }

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
