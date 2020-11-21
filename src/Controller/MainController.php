<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $transport;
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        $packageInfo = $this->generatePackages();
        $this->dispatchPackage($packageInfo);
        $packages = $this->transport;
        $machines = $this->getMachines();

//        var_dump($this->transport);
        if(php_sapi_name() == "cli"){
            echo "Dziękuje za uruchomienie mnie z konsoli :) \n";
            $this->console($this->transport, $machines, $packageInfo);

        }

//            var_dump($this->transport);

//        var_dump($this->getMachines());
            return $this->render('main/index.html.twig', [
                'package_info' => $packageInfo,
                'packages' => $packages,
                'machines' => $machines
            ]);
    }

    public function generatePackages()
    {
        $packageNum = rand(5,40);

        for($i=1; $i<=$packageNum; $i++){
            $arr[$i] = rand(10,20);
        }

        $obj = new \stdClass();
        $obj->num_of_packages = $packageNum;
        $obj->package_arr = $arr;

        return $obj;
    }

    public function dispatchPackage($packageInfo){

        if(is_object($packageInfo)) {
            $package = $packageInfo->package_arr;
        }else{
            $package = $packageInfo;
        }
        $sum = 0;

        foreach ($package as $key => $value) {
                if ($sum + $value <= 200) {
                        $sum += $value;
                        $truck[$key] = $value;

                    }else{
                        $rest[$key] = $value;
                        unset($key);
                    }
                }
        $truck['suma'] = $sum;
        $this->transport[] = $truck;
        if(!empty($rest)){
            $this->dispatchPackage($rest);
        }

        }

        public function console($data, $machines, $packageInfo){

        echo "Paczki: ".$packageInfo->num_of_packages."\n";
        $i = 1;
        foreach ($data as $paczki){
            echo "Samochód ".$i."\n";
            print_r($paczki);
            $i++;
        }

        echo "Samolot: \n";
        print_r($machines);

        die;
        }

        public function getMachines(){

            return array(
              0 => 1.5,
              1 => 2
            );
        }
}
