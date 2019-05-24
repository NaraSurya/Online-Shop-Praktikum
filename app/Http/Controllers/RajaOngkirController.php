<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Exception\RequestExceptionInterface;

class RajaOngkirController extends Controller
{
    
    public function getProvinsi(){
        $client = new Client();
        try{
            $response = $client->get('https://api.rajaongkir.com/starter/province',
                array(
                    'headers' => array(
                        'key' => '67080eb678897a09f70e6c8ae553f4cf'
                    )
                )
            );
        } catch (RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);

        return $array_result["rajaongkir"]["results"][1]["province"];

    }
    public function getCity(){
        $client = new Client();
        try{
            $response = $client->get('https://api.rajaongkir.com/starter/city',
                array(
                    'headers' => array(
                        'key' => '67080eb678897a09f70e6c8ae553f4cf'
                    )
                )
            );
        } catch (RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);

        return $array_result["rajaongkir"]["results"][1]["city_name"];

    }
    public function checkShipping(){
        $client = new Client();
        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
               [
                'body' => "origin=501&destination=114&weight=1700&courier=jne",
                'headers' => [
                    'key' => '67080eb678897a09f70e6c8ae553f4cf',
                    "content-type" => "application/x-www-form-urlencoded",
                ]
               ]
            );
        } catch (RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);

        return $array_result["rajaongkir"]["results"][0]["costs"][1]["cost"][0]["value"];

    }
}
