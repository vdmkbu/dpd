<?php

namespace Vdmkbu\Dpd\Services\Order;


use Vdmkbu\Dpd\API\ClientFactory;
use Vdmkbu\Dpd\Config;

class OrderTracking
{
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
        $wsdl = "tracing?wsdl";
        $this->client = ClientFactory::create($wsdl, $config);
    }

    public function getStatusList($code)
    {
        // номер заказа
        $request['dpdOrderNr'] = $code;
        $response = $this->client->execute('getStatesByDPDOrder', $request, 'request');

        return $response;
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

    protected function translateStates($state)
    {

        return $this->translateStates[$state];
    }
}