<?php

namespace Vdmkbu\Dpd;


class Order
{
    protected $config;
    protected $translateStates = [
        'NewOrderByClient'=>'оформлен новый заказ по инициативе клиента',
        'NotDone'=>'заказ отменен',
        'OnTerminalPickup'=>'посылка находится на терминале приема отправления',
        'OnRoad'=>'посылка находится в пути',
        'OnTerminal'=>'посылка находится на транзитном терминале',
        'OnTerminalDelivery'=>'посылка находится на терминале доставки',
        'Delivering'=>'посылка выведена на доставку',
        'Delivered'=>'посылка доставлена получателю',
        'Lost'=>'посылка утеряна',
        'Problem'=>'с посылкой возникла проблемная ситуация',
        'ReturnedFromDelivery'=>'посылка возвращена с доставки',
        'NewOrderByDPD'=>'оформлен новый заказ по инициативе DPD'
    ];

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getStatusList($code)
    {

        $config = $this->config;

        $server = $config->get('server');
        $clientNumber = $config->get('clientNumber');
        $clientKey = $config->get('clientKey');

        $url = "{$server}tracing?wsdl";
        $client = new \SoapClient($url);

        // авторизация
        $arData['auth'] = [
            'clientNumber' => $clientNumber,
            'clientKey' => $clientKey
        ];

        // номер заказа
        $arData['dpdOrderNr'] = $code;

        $arRequest['request'] = $arData;

        //var_dump($arRequest);

        try {
            $result = $client->getStatesByDPDOrder($arRequest);

            return $result;
        } catch (\Exception $e) {
            var_dump($e);
        }

    }

    public function getLastStatus($code)
    {

        $statuses = $this->getStatusList($code);

        if($statuses) {
            $states = $statuses->return->states;
            $statesCount = count($states);

            $lastStatus = $states[$statesCount-1]->newState;
            $transitionTime = $states[$statesCount-1]->transitionTime;
            $terminalCity = $states[$statesCount-1]->terminalCity;

            return [
                'state'=>$this->translateStates[$lastStatus],
                'transitionTime'=>$transitionTime,
                'terminalCity'=>$terminalCity
            ];
        }



    }

    public function translateStates($state)
    {

        return $this->translateStates[$state];
    }



}