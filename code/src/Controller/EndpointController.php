<?php


namespace App\Controller;


use App\Resources\Output\Messenger;
use Slim\Views\Twig;

class EndpointController
{
    public function index($request, $response, Twig $twig)
    {
        $client = new \GuzzleHttp\Client();
        $baseUrl = "https://api.binance.com";
        $uri = "/api/v3/ticker/24hr";

        $start = microtime(true);
        $gResponse = $client->request('GET', $baseUrl . $uri ,
            [
            'query'=>[
                //'symbol' => "BNBBTC"
            ]
        ]);
        $end = microtime(true);
        $diff = $end - $start;
        Messenger::addWarning(' duration: '. $diff);

        if($gResponse->getStatusCode() > 400)
        {
            Messenger::addError('Watch out! Status Code ' . $gResponse->getStatusCode());
        } else {
            Messenger::addSuccess('Status Code '. $gResponse->getStatusCode());
        }

        $message = $gResponse->getBody();
        //Messenger::addSuccess($message);
        //$gResponse = $client->request('GET', 'http://nginx:80/api/role');
        $curl_result = json_decode('[' . $gResponse->getBody() . ']');

        return $twig->render($response, 'res/endpoint/index.twig', compact('message', 'curl_result'));
    }
}