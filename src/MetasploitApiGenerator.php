<?php

namespace Krzychu12350\MetasploitApi;


use Krzychu12350\MetasploitApi\Http\Requests\ApiFormRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Krzychu12350\MetasploitApi\Http\Controllers\Controller;
use Krzychu12350\Phpmetasploit\MsfRpcClient;
use Nette\PhpGenerator as PhpGenerator;
use Krzychu12350\Phpmetasploit\AuthApiMethods;
use Psy\Reflection\ReflectionNamespace;
use ReflectionClass;
use ReflectionMethod;


class MetasploitApiGenerator
{

    public static function fetchClassesFromSpecificNamespace($namespace): array
    {
        $namespace .= '\\';
        $myClasses = array_filter(get_declared_classes(), function ($item) use ($namespace) {
            return substr($item, 0, strlen($namespace)) === $namespace;
        });
        $theClasses = [];
        foreach ($myClasses as $class):
            $theParts = explode('\\', $class);
            $theClasses[] = end($theParts);
        endforeach;
        return $theClasses;
    }

    public static function generateApi2()
    {
        $userPassword = "pass123";
        $ssl = "true";
        $userName = "user";
        $ip = "127.0.0.1";
        $port = 55553;
        $webServerURI = "/api/1.0";
        $msfRpcClient = new MsfRpcClient($userPassword, $ssl, $userName, $ip, $port, $webServerURI);
        echo $msfRpcClient->msfAuth();
    }

    /**
     * @throws Exception
     */
    public static function generateApi()
    {
        // echo 'It works';


        //$methods = $f->getMethods();
        //print_r($methods);
        //foreach ($methods as $method)
        //   if ( $f->class == 'AuthApiMethods')
        //    echo $method->getName() . PHP_EOL;
        //$methods = get_class_methods("Krzychu12350\\Phpmetasploit\\AuthApiMethods");

        $methodsForPassingToController = [];

        //Generating Controllers

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
            $publicMethodsOfParentClass = ['msf_execute', '__construct', 'msfAuth', 'msf_console','setToken'];
            $allMethods = [];
            //print_r(array_diff($allMethods, $publicMethodsOfParentClass));


            //get all methods in specific class
            foreach ($f->getMethods(ReflectionMethod::IS_PUBLIC) as $method) $allMethods[] = $method->getName();

            $class->addProperty(strtolower($controllerName) . 'ApiMethods')->setType('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods')->setPrivate();

            $class->addMethod('__construct')->setBody('$this->' .
                strtolower($controllerName) . 'ApiMethods = new ' . $controllerName . 'ApiMethods();');


            //generating methods according to krzychu12350//phpmetasploit
            foreach (array_diff($allMethods, $publicMethodsOfParentClass) as $singleMethod) {

                //echo $singleMethod . PHP_EOL;


                //generating methods params according to krzychu12350//phpmetasploit
                $r = new ReflectionMethod('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods', $singleMethod);
                $paramsFromReflection = $r->getParameters();
                //var_dump($paramsFromReflection);

                $currentMethodParams = [];
                $currentMethodParamsInternalCalling = [];
                foreach ($paramsFromReflection as $reflectionParameter) {
                    $currentMethodParams[] = '$request->' . $reflectionParameter->getName();
                    $currentMethodParamsInternalCalling[] = "$" . $reflectionParameter->getName();
                }
                $methodEndpointName = strtolower(implode("-", preg_split("/(?=[A-Z])/", $singleMethod)));
                $method = $class->addMethod($singleMethod)->setPublic()->setReturnType(JsonResponse::class)
                    ->setBody('$this->' . strtolower($controllerName)
                        . 'ApiMethods->setToken($request->header("Authorization"));
                    $data = $this->' . strtolower($controllerName) . 'ApiMethods->' . $singleMethod .
                        '(' . implode(', ', $currentMethodParams) . ');
                return response()->json(["status" => true,
                "message" => "' . $singleMethod . '" . "Works!!!",
                "data" => $data ], 200);')
                    //->addAttribute('Spatie\RouteDiscovery\Attributes\Route', ['fullUri' => '\\' . $singleMethod]);;
                    ->addAttribute('Spatie\RouteAttributes\Attributes\Post', [strtolower($controllerName) . '/' .
                        $methodEndpointName]);

                var_dump($methodEndpointName);


                //strtolower(
                if (empty($currentMethodParamsInternalCalling)) {
                    $namespace->addUse('Illuminate\Http\Request');
                    $method->addParameter("request")
                        ->setType('Illuminate\Http\Request');
                } else {

                    $namespace->addUse('Krzychu12350\MetasploitApi\Http\Requests\\' .
                        $controllerName . $singleMethod . "Request");
                    $method->addParameter("request")
                        ->setType('Krzychu12350\MetasploitApi\Http\Requests\\' .
                            $controllerName . $singleMethod . "Request");
                }


                //foreach ($currentMethodParams as $singleParam) $method->addParameter($singleParam);


                file_put_contents(dirname(__FILE__) .
                    '\\Http\\Controllers\\' . $className . '.php', $file);
            }
        }

        //Generating FormRequests
        $controllerNames = ['Auth', 'Console', 'Core', 'Job', 'Module', 'Plugin', 'Session'];
        foreach ($controllerNames as $controllerName) {

            //getting all methods of specific methodsApi class
            $f = new ReflectionClass('Krzychu12350\\Phpmetasploit\\' . $controllerName . 'ApiMethods');
            $publicMethodsOfParentClass = ['msf_execute', '__construct', 'msfAuth', 'msf_console'];
            $allMethods = [];
            //print_r(array_diff($allMethods, $publicMethodsOfParentClass));


            //get all methods in specific class
            foreach ($f->getMethods(ReflectionMethod::IS_PUBLIC) as $method) $allMethods[] = $method->getName();

            //$publicMethods = array_diff($allMethods, $publicMethodsOfParentClass);
            //var_dump($publicMethods);
            foreach (array_diff($allMethods, $publicMethodsOfParentClass) as $singleMethod) {
                $r = new ReflectionMethod('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods', $singleMethod);
                $paramsFromReflection = $r->getParameters();
                //var_dump($singleMethod, $paramsFromReflection);

                if (!empty($paramsFromReflection)) {
                    echo PHP_EOL;
                    echo ($singleMethod) . "METHOD" . PHP_EOL;
                    $file = new PhpGenerator\PhpFile;
                    $namespace = $file->addNamespace('Krzychu12350\MetasploitApi\Http\Requests');
                    $namespace->addUse("Krzychu12350\MetasploitApi\Http\Requests\ApiFormRequest");

                    //$className = $controllerName . 'ApiController';
                    $class = $namespace->addClass($controllerName . $singleMethod . "Request");
                    $class->setExtends("Krzychu12350\MetasploitApi\Http\Requests\ApiFormRequest");

                    //$test = implode(', ', $paramsFromReflection);
                    //var_dump($test);

                    $currentMethodParamss = array();
                    foreach ($paramsFromReflection as $reflectionParameter) {
                        $currentMethodParamss[] = "'" . $reflectionParameter->getName() . "' => 'required'";
                    }
                    //echo($currentMethodParams) . PHP_EOL;
                    print_r(implode(', ', $currentMethodParamss));
                    echo PHP_EOL;

                    $class->addMethod('rules')->setPublic()
                        ->setBody('return [' . implode(', ', $currentMethodParamss) . '];');
                    $class->addMethod('authorize')->setPublic()->setBody('return true;');

                    file_put_contents(dirname(__FILE__) .
                        '\\Http\\Requests\\' . $controllerName . $singleMethod . 'Request.php', $file);
                }


            }


        }
    }
}

