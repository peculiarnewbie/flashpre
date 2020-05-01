<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;

    // https://stackoverflow.com/questions/36188800/class-users-not-found-in-phalcon-2
// use Phalcon\Mvc\Micro;
// use Phalcon\Events\Manager as EventsManager;
// define('APP_DIR', dirname(__DIR__) .'/');


error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');


try {
    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    // $container->set(
    //     'db',
    //     function () {
    //         return new Mysql(
    //             [
    //                 'host'     => '127.0.0.1',
    //                 'username' => 'root',
    //                 'password' => 'secret',
    //                 'dbname'   => 'tutorial',
    //             ]
    //         );
    //     }
    // );

    // https://stackoverflow.com/questions/36188800/class-users-not-found-in-phalcon-2
    // $config = require APP_DIR .'config/config.php';
    // require APP_DIR .'config/loader.php';


    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
