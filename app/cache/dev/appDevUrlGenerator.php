<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appDevUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRoutes = array(
        '_wdt' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:toolbarAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/_wdt',    ),  ),  4 =>   array (  ),),
        '_profiler_home' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:homeAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/',    ),  ),  4 =>   array (  ),),
        '_profiler_search' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/search',    ),  ),  4 =>   array (  ),),
        '_profiler_search_bar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchBarAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/search_bar',    ),  ),  4 =>   array (  ),),
        '_profiler_purge' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:purgeAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/purge',    ),  ),  4 =>   array (  ),),
        '_profiler_info' => array (  0 =>   array (    0 => 'about',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:infoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'about',    ),    1 =>     array (      0 => 'text',      1 => '/_profiler/info',    ),  ),  4 =>   array (  ),),
        '_profiler_import' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:importAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/import',    ),  ),  4 =>   array (  ),),
        '_profiler_export' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:exportAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '.txt',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/\\.]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler/export',    ),  ),  4 =>   array (  ),),
        '_profiler_phpinfo' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/phpinfo',    ),  ),  4 =>   array (  ),),
        '_profiler_search_results' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:searchResultsAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/search/results',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),),
        '_profiler' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.profiler:panelAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),),
        '_profiler_router' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.router:panelAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/router',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),),
        '_profiler_exception' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.exception:showAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/exception',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),),
        '_profiler_exception_css' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'web_profiler.controller.exception:cssAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/exception.css',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),  4 =>   array (  ),),
        '_configurator_home' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_configurator/',    ),  ),  4 =>   array (  ),),
        '_configurator_step' => array (  0 =>   array (    0 => 'index',  ),  1 =>   array (    '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'index',    ),    1 =>     array (      0 => 'text',      1 => '/_configurator/step',    ),  ),  4 =>   array (  ),),
        '_configurator_final' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_configurator/final',    ),  ),  4 =>   array (  ),),
        'componente_universo' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\ComponenteBundle\\Controller\\ComponenteController::universoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/componente/universo',    ),  ),  4 =>   array (  ),),
        'componente_perfil' => array (  0 =>   array (    0 => 'serie',  ),  1 =>   array (    '_controller' => 'Piddo\\ComponenteBundle\\Controller\\ComponenteController::perfilAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/perfil',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'serie',    ),    2 =>     array (      0 => 'text',      1 => '/componente',    ),  ),  4 =>   array (  ),),
        'recepcion_portada' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::portadaRecepcionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/recepcion/',    ),  ),  4 =>   array (  ),),
        'recepcion_crear_presupuesto' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::crearPresupuestoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/creauno/presupuesto/',    ),  ),  4 =>   array (  ),),
        'recepcion_crear_motor' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::crearMotorAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/crea/motor',    ),  ),  4 =>   array (  ),),
        'recepcion_crear_motor_modelo' => array (  0 =>   array (    0 => 'marca',  ),  1 =>   array (    '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::crearMotorModeloAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/modelo',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'marca',    ),    2 =>     array (      0 => 'text',      1 => '/crea',    ),  ),  4 =>   array (  ),),
        'recepcion_crear_motor_modelo_serie' => array (  0 =>   array (    0 => 'marca',    1 => 'modelo',  ),  1 =>   array (    '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::crearMotorModeloSerieAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/serie',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'modelo',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'marca',    ),    3 =>     array (      0 => 'text',      1 => '/crea',    ),  ),  4 =>   array (  ),),
        'recepcion_agregar_cliente' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\RecepcionBundle\\Controller\\DefaultController::agregarClienteAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/agregar/cliente/',    ),  ),  4 =>   array (  ),),
        'repuesto_portada' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\RepuestoBundle\\Controller\\DefaultController::repuestoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/repuesto',    ),  ),  4 =>   array (  ),),
        'repuesto_lista_solicitudes' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\RepuestoBundle\\Controller\\DefaultController::listaSolicitudesAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/repuesto/solicitudes',    ),  ),  4 =>   array (  ),),
        'repuesto_presupuestos' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\RepuestoBundle\\Controller\\DefaultController::listaPresupuestosAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/repuesto/presupuestos',    ),  ),  4 =>   array (  ),),
        'repuesto_lista' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\RepuestoBundle\\Controller\\DefaultController::listaAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/repuesto/lista',    ),  ),  4 =>   array (  ),),
        'nuevo_presupuesto' => array (  0 =>   array (    0 => 'presupuesto',  ),  1 =>   array (    '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::nuevoAction',    'presupuesto' => NULL,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'presupuesto',    ),    1 =>     array (      0 => 'text',      1 => '/nuevo-presupuesto',    ),  ),  4 =>   array (  ),),
        'presupuesto_recepcion' => array (  0 =>   array (    0 => 'presupuesto',  ),  1 =>   array (    '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::recepcionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'presupuesto',    ),    1 =>     array (      0 => 'text',      1 => '/presupuesto/recepcion',    ),  ),  4 =>   array (  ),),
        'presupuesto_trabajos' => array (  0 =>   array (    0 => 'presupuesto',  ),  1 =>   array (    '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::trabajosAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'presupuesto',    ),    1 =>     array (      0 => 'text',      1 => '/presupuesto/trabajos',    ),  ),  4 =>   array (  ),),
        'presupuesto_repuestos' => array (  0 =>   array (    0 => 'presupuesto',  ),  1 =>   array (    '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::repuestosAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'presupuesto',    ),    1 =>     array (      0 => 'text',      1 => '/presupuesto/repuestos',    ),  ),  4 =>   array (  ),),
        'presupuesto_final' => array (  0 =>   array (    0 => 'presupuesto',  ),  1 =>   array (    '_controller' => 'Piddo\\PresupuestoBundle\\Controller\\PresupuestoController::finalAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'presupuesto',    ),    1 =>     array (      0 => 'text',      1 => '/presupuesto/final',    ),  ),  4 =>   array (  ),),
        'admin_clientes' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\ClienteBundle\\Controller\\DefaultController::registroAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/registro-cliente',    ),  ),  4 =>   array (  ),),
        'rectificado_universo' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\TallerBundle\\Controller\\RectificadosController::universoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/taller/universo',    ),  ),  4 =>   array (  ),),
        'rectificado_perfil' => array (  0 =>   array (    0 => 'serie',  ),  1 =>   array (    '_controller' => 'Piddo\\TallerBundle\\Controller\\RectificadosController::perfilAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/perfil',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'serie',    ),    2 =>     array (      0 => 'text',      1 => '/taller',    ),  ),  4 =>   array (  ),),
        'portada_gerencia' => array (  0 =>   array (    0 => 'index',  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::portadaGerenciaAction',    'index' => 0,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'index',    ),    1 =>     array (      0 => 'text',      1 => '/administracion/portada',    ),  ),  4 =>   array (  ),),
        'admin_marcas' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::marcasAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/administracion/marcas',    ),  ),  4 =>   array (  ),),
        'borrar_marca' => array (  0 =>   array (    0 => 'marca',  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::borrarMarcaAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '-',      2 => '[^/]++',      3 => 'marca',    ),    1 =>     array (      0 => 'text',      1 => '/administracion/marcas/borrar',    ),  ),  4 =>   array (  ),),
        'admin_modelos' => array (  0 =>   array (    0 => 'marca',  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::modelosAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/modelos',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'marca',    ),    2 =>     array (      0 => 'text',      1 => '/administracion',    ),  ),  4 =>   array (  ),),
        'borrar_modelo' => array (  0 =>   array (    0 => 'marca',    1 => 'modelo',  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::borrarModeloAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '-',      2 => '[^/]++',      3 => 'modelo',    ),    1 =>     array (      0 => 'text',      1 => '/borrar',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'marca',    ),    3 =>     array (      0 => 'text',      1 => '/administracion',    ),  ),  4 =>   array (  ),),
        'admin_series' => array (  0 =>   array (    0 => 'marca',    1 => 'modelo',  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::seriesAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/series',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'modelo',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'marca',    ),    3 =>     array (      0 => 'text',      1 => '/administracion',    ),  ),  4 =>   array (  ),),
        'borrar_serie' => array (  0 =>   array (    0 => 'marca',    1 => 'modelo',    2 => 'serie',  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::borrarSerieAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '-',      2 => '[^/]++',      3 => 'serie',    ),    1 =>     array (      0 => 'text',      1 => '/borrar',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'modelo',    ),    3 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'marca',    ),    4 =>     array (      0 => 'text',      1 => '/administracion',    ),  ),  4 =>   array (  ),),
        'serie_col_piezas' => array (  0 =>   array (    0 => 'marca',    1 => 'modelo',    2 => 'serie',  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::ColPiezasAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/piezas',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'serie',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'modelo',    ),    3 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'marca',    ),    4 =>     array (      0 => 'text',      1 => '/administracion',    ),  ),  4 =>   array (  ),),
        'agregar_repuestos' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::agregarRepuestosAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/administracion/repuestos',    ),  ),  4 =>   array (  ),),
        'precios' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\PreciosController::preciosAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/precios',    ),  ),  4 =>   array (  ),),
        'tipo' => array (  0 =>   array (    0 => 'tipo',  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\PreciosController::tiposAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'tipo',    ),    1 =>     array (      0 => 'text',      1 => '/precios',    ),  ),  4 =>   array (  ),),
        'admin_casilleros' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\AdminBundle\\Controller\\DefaultController::casillerosAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/administracion/casilleros',    ),  ),  4 =>   array (  ),),
        'usuario_registro' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\UsuarioBundle\\Controller\\DefaultController::registroAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/registro',    ),  ),  4 =>   array (  ),),
        'usuario_logout' => array (  0 =>   array (  ),  1 =>   array (  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/logout',    ),  ),  4 =>   array (  ),),
        'usuario_login_check' => array (  0 =>   array (  ),  1 =>   array (  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login_check',    ),  ),  4 =>   array (  ),),
        'usuario_login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Piddo\\UsuarioBundle\\Controller\\DefaultController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),  4 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens);
    }
}
