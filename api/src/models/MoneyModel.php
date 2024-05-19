<?php
namespace case\models;

class MoneyModel 
{    
    public function getRate()
    {   
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/convert?to=uah&from=usd&amount=1",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "apikey: bZZ2pyQhekFZ1Lthb5PbPBCrm2xKJ70G"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}