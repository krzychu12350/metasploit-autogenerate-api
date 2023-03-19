<?php

namespace Krzychu12350\MetasploitApi;

use Illuminate\Http\JsonResponse;
use Krzychu12350\MetasploitApi\Http\Controllers\Controller;
use Krzychu12350\MetasploitApi\Traits\MsfRpcClientInitializerTrait;
use Nette\PhpGenerator as PhpGenerator;
use ReflectionClass;
use ReflectionMethod;

class MetasploitApiGenerator
{
    public static function generateApi()
    {
        //Generating Controllers
        $controllerNames = ['Auth', 'Console', 'Core', 'Job', 'Module', 'Plugin', 'Session'];
        foreach ($controllerNames as $controllerName) {
            $file = new PhpGenerator\PhpFile;
            $namespace = $file->addNamespace('Krzychu12350\MetasploitApi\Http\Controllers');
            $namespace->addUse('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods');
            $namespace->addUse('Illuminate\Http\JsonResponse');
            $namespace->addUse('Spatie\RouteAttributes\Attributes\Post');
            $namespace->addUse('Krzychu12350\MetasploitApi\Traits\MsfRpcClientInitializerTrait');

            $className = $controllerName . 'ApiController';
            $class = $namespace->addClass($className);
            $class->setExtends(Controller::class);
            $class->addTrait(MsfRpcClientInitializerTrait::class);
            //getting all methods of specific methodsApi class
            $f = new ReflectionClass('Krzychu12350\\Phpmetasploit\\' . $controllerName . 'ApiMethods');
            $publicMethodsOfParentClass = ['msf_execute', '__construct', 'msfAuth', 'msf_console', 'setToken'];
            $allMethods = [];
            //get all methods in specific class
            foreach ($f->getMethods(ReflectionMethod::IS_PUBLIC) as $method) $allMethods[] = $method->getName();
            $class->addProperty(strtolower($controllerName) . 'ApiMethods')
                ->setType('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods')->setPrivate();
            $class->addMethod('__construct')->setBody('$this->initializeMsfRpcClient();' . "\n" . '$this->' .
                strtolower($controllerName) . 'ApiMethods = new ' . $controllerName . 'ApiMethods();');
            //generating methods according to krzychu12350//phpmetasploit
            foreach (array_diff($allMethods, $publicMethodsOfParentClass) as $singleMethod) {
                //generating methods params according to krzychu12350//phpmetasploit
                $r = new ReflectionMethod('Krzychu12350\Phpmetasploit\\' . $controllerName . 'ApiMethods',
                    $singleMethod);
                $paramsFromReflection = $r->getParameters();
                $currentMethodParams = [];
                $currentMethodParamsInternalCalling = [];
                foreach ($paramsFromReflection as $reflectionParameter) {
                    $currentMethodParams[] = '$request->' .
                        self::convertCamelCaseStringToSnakeCase($reflectionParameter->getName());
                    $currentMethodParamsInternalCalling[] = "$" .
                        self::convertCamelCaseStringToSnakeCase($reflectionParameter->getName());
                }
                $methodEndpointName = strtolower(implode("-", preg_split("/(?=[A-Z])/", $singleMethod)));
                $method = $class->addMethod($singleMethod)->setPublic()->setReturnType(JsonResponse::class)
                    ->setBody('try {' . "\n\t" . '$this->' . strtolower($controllerName)
                        . 'ApiMethods->setToken($request->header("Authorization"));'
                        . "\n\t" . '$data = $this->' . strtolower($controllerName) . 'ApiMethods->' . $singleMethod .
                        '(' . implode(', ', $currentMethodParams) . ');' . "\n\t" .
                        'return response()->json([' . "\n\t\t" . '"status" => true, ' . "\n\t\t" . '"data" => $data], '
                        . "\n\t\t" . '200);' . "\n" .
                        '} catch (\Exception $e) {' . "\n\t" . 'return response()->json([' . "\n\t\t" .
                        '"status" => false,' . "\n\t\t" . '"message" => $e->getMessage(),' . "\n\t" .
                        '],' . "\n\t\t" . '$e->getCode());' . "\n" . '}'
                    )
                    ->addAttribute('Spatie\RouteAttributes\Attributes\Post', [strtolower($controllerName) . '/' .
                        $methodEndpointName]);
                if (empty($currentMethodParamsInternalCalling)) {
                    $namespace->addUse('Illuminate\Http\Request');
                    $method->addParameter("request")
                        ->setType('Illuminate\Http\Request');
                } else {
                    $namespace->addUse('Krzychu12350\MetasploitApi\Http\Requests\\' .
                        $controllerName . "\\" .
                        $controllerName . ucfirst($singleMethod) . "Request");
                    $method->addParameter("request")
                        ->setType('Krzychu12350\MetasploitApi\Http\Requests\\' .
                            $controllerName . "\\" .
                            $controllerName . ucfirst($singleMethod) . "Request");
                }
                file_put_contents(dirname(__FILE__) .
                    '/Http/Controllers/' . $className . '.php', $file);
            }
        }

        //Generating FormRequests
        $controllerNames = ['Auth', 'Console', 'Core', 'Job', 'Module', 'Plugin', 'Session'];
        foreach ($controllerNames as $controllerName) {
            $dirPath = dirname(__FILE__) .
                '/Http/Requests/' . $controllerName;
            if (is_dir($dirPath) == 0) mkdir($dirPath);
            //getting all methods of specific methodsApi class
            $f = new ReflectionClass('Krzychu12350\\Phpmetasploit\\' . $controllerName . 'ApiMethods');
            $publicMethodsOfParentClass = ['msf_execute', '__construct', 'msfAuth', 'msf_console'];
            $allMethods = [];
            //get all methods in specific class
            foreach ($f->getMethods(ReflectionMethod::IS_PUBLIC) as $method) $allMethods[] = $method->getName();
            foreach (array_diff($allMethods, $publicMethodsOfParentClass) as $singleMethod) {
                $r = new ReflectionMethod('Krzychu12350\Phpmetasploit\\'
                    . $controllerName . 'ApiMethods', $singleMethod);
                $paramsFromReflection = $r->getParameters();
                if (!empty($paramsFromReflection)) {
                    $file = new PhpGenerator\PhpFile;
                    $namespace = $file
                        ->addNamespace('Krzychu12350\MetasploitApi\Http\Requests\\' . $controllerName);
                    $namespace->addUse("Krzychu12350\MetasploitApi\Http\Requests\ApiFormRequest");
                    $class = $namespace->addClass($controllerName . ucfirst($singleMethod) . "Request");
                    $class->setExtends("Krzychu12350\MetasploitApi\Http\Requests\ApiFormRequest");
                    $currentMethodParamss = array();
                    foreach ($paramsFromReflection as $reflectionParameter) {
                        $currentMethodParamss[] = "'" .
                            self::convertCamelCaseStringToSnakeCase($reflectionParameter
                                ->getName()) . "' => 'required'";
                    }
                    $class->addMethod('rules')->setPublic()
                        ->setBody('return [' . implode(', ', $currentMethodParamss) . '];');
                    $class->addMethod('authorize')->setPublic()->setBody('return true;');
                    file_put_contents(dirname(__FILE__) .
                        '/Http/Requests/' . $controllerName . "/" . $controllerName . ucfirst($singleMethod) .
                        'Request.php', $file);
                }
            }
        }
    }

    public static function convertCamelCaseStringToSnakeCase($str, $separator = "_")
    {
        if (empty($str)) {
            return $str;
        }
        $str = lcfirst($str);
        $str = preg_replace("/[A-Z]/", $separator . "$0", $str);
        return strtolower($str);
    }
}

