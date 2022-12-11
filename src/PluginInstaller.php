<?php

namespace Krzychu12350\MetasploitApi;

use Composer\Composer;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\PluginEvents;
use Composer\Plugin\PostFileDownloadEvent;
use Composer\Plugin\PreFileDownloadEvent;
use Illuminate\Http\JsonResponse;
use Krzychu12350\MetasploitApi\Http\Controllers\Controller;

class PluginInstaller implements PluginInterface, EventSubscriberInterface
{
    protected $composer;
    protected $io;

    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
        //var_dump("dddddddddddddddddddd");
        /*
        if (!file_exists(dirname(__FILE__) . '\\methods'))
            mkdir(dirname(__FILE__) . '\\methods', 0777, true);
        */
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {

    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            'post-package-install' => 'onPostPackageInstallOrUpdate',
            'post-package-update' => 'onPostPackageInstallOrUpdate'
        ];
    }

    public function onPostPackageInstallOrUpdate(PackageEvent $event)
    {
        //$vendorDir = $event->getComposer()->getConfig()->get('vendor-dir') . '/';

        /** @var InstallOperation $item */
        ///$this->createApiMethods();

        $metasploitApiGenerator = new MetasploitApiGenerator();
        $metasploitApiGenerator::generateApi();

        //$this->generateApi();
        /*
        foreach ($event->getOperations() as $item) {

            $packageInstalled = $item->getPackage()->getName();
            // do any thing with the package name like `laravel/laravel`
            //You can now edit the composer.json file

            echo $vendorDir . $packageInstalled . '/composer.json';

        }
        */

    }


    public function generateApi()
    {
        // echo 'It works';


        //$methods = $f->getMethods();
        //print_r($methods);
        //foreach ($methods as $method)
        //   if ( $f->class == 'AuthApiMethods')
        //    echo $method->getName() . PHP_EOL;
        //$methods = get_class_methods("Krzychu12350\\Phpmetasploit\\AuthApiMethods");

        $methodsForPassingToController = [];


        $controllerNames = ['Auth', 'Console', 'Core', 'Job', 'Module', 'Plugin', 'Session'];
        foreach ($controllerNames as $controllerName) {
            $file = new PhpGenerator\PhpFile;
            $namespace = $file->addNamespace('Krzychu12350\MetasploitApi\Http\Controllers');
            $namespace->addUse('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods');
            $namespace->addUse('Krzychu12350\Phpmetasploit\MsfRpcClient');
            $namespace->addUse('Illuminate\Http\JsonResponse');
            $namespace->addUse('Spatie\RouteAttributes\Attributes\Post');


            $className = $controllerName . 'ApiController';
            $class = $namespace->addClass($className);
            $class->setExtends(Controller::class);

            //getting all methods of specific methodsApi class
            $f = new ReflectionClass('Krzychu12350\\Phpmetasploit\\' . $controllerName . 'ApiMethods');
            $publicMethodsOfParentClass = ['msf_execute', '__construct', 'msfAuth', 'msf_console'];
            $allMethods = [];
            //print_r(array_diff($allMethods, $publicMethodsOfParentClass));


            //get all methods in specific class
            foreach ($f->getMethods(ReflectionMethod::IS_PUBLIC) as $method) $allMethods[] = $method->getName();

            $class->addProperty(strtolower($controllerName) . 'ApiMethods')->setType('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods')->setPrivate();

            $class->addMethod('__construct')->setBody('$this->' .
                strtolower($controllerName) . 'ApiMethods = new ' . $controllerName . 'ApiMethods();');


            //generating methods according to krzychu12350//phpmetasploit
            foreach (array_diff($allMethods, $publicMethodsOfParentClass) as $singleMethod) {

                echo $singleMethod . PHP_EOL;


                //generating methods params according to krzychu12350//phpmetasploit
                $r = new ReflectionMethod('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods', $singleMethod);
                $paramsFromReflection = $r->getParameters();
                //var_dump($paramsFromReflection);

                $currentMethodParams = [];
                $currentMethodParamsInternalCalling = [];
                foreach ($paramsFromReflection as $reflectionParameter) {
                    $currentMethodParams[] = $reflectionParameter->getName();
                    $currentMethodParamsInternalCalling[] = "$" . $reflectionParameter->getName();
                }


                $method = $class->addMethod($singleMethod)->setPublic()->setReturnType(JsonResponse::class)
                    ->setBody('$data = $this->' . strtolower($controllerName) . 'ApiMethods->' . $singleMethod .
                        '(' . implode(', ', $currentMethodParamsInternalCalling) . ');
                    return response()->json(["status" => true,
                    "message" => "' . $singleMethod . '" . "Works!!!",
                    "data" => $data ], 200);')
                    //->addAttribute('Spatie\RouteDiscovery\Attributes\Route', ['fullUri' => '\\' . $singleMethod]);;
                    ->addAttribute('Spatie\RouteAttributes\Attributes\Post', [strtolower($controllerName) . '/' .
                        implode("-", preg_split("/(?=[A-Z])/", $singleMethod))]);


                foreach ($currentMethodParams as $singleParam) $method->addParameter($singleParam);


                file_put_contents(dirname(__FILE__) .
                    '\\Http\\Controllers\\' . $className . '.php', $file);
            }
        }
    }

}
