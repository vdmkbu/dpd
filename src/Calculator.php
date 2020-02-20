<?php

namespace Vdmkbu\Dpd;


class Calculator
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getDeliveryCost(Shipment $shipment)
    {
        $config = $this->config;

        $server = $config->get('server');
        $clientNumber = $config->get('clientNumber');
        $clientKey = $config->get('clientKey');

        $client = new \SoapClient("{$server}calculator2?wsdl");

        // авторизация
        $arData['auth'] = [
            'clientNumber'=>$clientNumber,
            'clientKey'=>$clientKey
        ];

        // город доставки
        $arData['delivery'] = [
            'cityId'=>$shipment->getReceiver()
        ];


        // город отправления
        $arData['pickup'] = [
            'cityId'=>$shipment->getSender()
        ];


        $arData['selfDelivery'] = $shipment->getSelfDelivery();
        $arData['selfPickup'] = $shipment->getPickup();

        $arData['weight'] = $shipment->getItemsWeight();

        // объявленная ценность груза: общая стоимость товаров
        $arData['declaredValue'] = $shipment->getItemsCost();

        $arRequest['request'] = $arData;

        try {
            $ret = $client->getServiceCost2($arRequest);

            return $ret;

        } catch (\Exception $e) {
            var_dump($e);
        }

    }

    public function getCostByCode($calc, $code)
    {
        foreach($calc->return as $calc_id => $calc_data) {
            if($calc_data->serviceCode == $code) {
                return $calc_data->cost;
            }
        }
    }

    public function getDaysByCode($calc, $code)
    {
        foreach($calc->return as $calc_id => $calc_data) {
            if($calc_data->serviceCode == $code) {
                return $calc_data->days;
            }
        }
    }

    public function getNameByCode($calc, $code)
    {
        foreach($calc->return as $calc_id => $calc_data) {
            if($calc_data->serviceCode == $code) {
                return $calc_data->serviceName;
            }
        }
    }

}