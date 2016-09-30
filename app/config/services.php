<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.html' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
//        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->setShared('router', function () {
    $router = new \Phalcon\Mvc\Router();
    $router->setDefaultNamespace('App\Controllers');
    return $router;
});
$di->setShared('dispatcher', function () {
    $eventsManager = new \Phalcon\Events\Manager();
    $eventsManager->attach("dispatch:beforeException", function ($event, $dispatcher, $exception) {
        if ($exception instanceof DispatcherException) {
            switch ($exception->getCode()) {
                case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward([
<<<<<<< HEAD
                        'controller' => 'errors',
                        'action'	 => 'show404',
=======
                        'controller' => 'index',
                        'action'	 => 'route404',
>>>>>>> c54a41009956d256a55c93eb4f32129358d96dec
                        'params'	 => array('message' => $exception->getMessage())
                    ]);
                    return false;
            }
        }
        $dispatcher->forward([
            'controller' => 'errors',
<<<<<<< HEAD
            'action'	 => 'show404'
=======
            'action'	 => 'show500'
>>>>>>> c54a41009956d256a55c93eb4f32129358d96dec
        ]);
        return false;
    });
    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setDefaultNamespace('App\Controllers');
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
});

$di->setShared('authen', 'App\Libs\Authen');
$di->setShared('common', 'App\Libs\Common');
$di->setShared('thirdpart', 'App\Libs\ThirdPart');
$di->setShared('captcha', 'App\Libs\Captcha');
