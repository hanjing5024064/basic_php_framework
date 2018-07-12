<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 10:27 AM
 */

namespace App;

use DI\ContainerBuilder;
use DI\Bridge\Slim\App as BaseApp;

class App extends BaseApp
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(__DIR__ . '/../config/my-config-file.php');
    }
}