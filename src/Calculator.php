<?php

namespace Vdmkbu\Dpd;


use Vdmkbu\Dpd\API\ClientFactory;

class Calculator
{
    protected $client;
    protected $config;
    protected $shipment;

    public function __construct(Shipment $shipment,  Config $config)
    {
        $wsdl = "calculator2?wsdl";
        $this->client = ClientFactory::create($wsdl, $config);
        $this->shipment = $shipment;
        $this->config = $config;
    }

    protected function commonRequest()
    {
        // город доставки
        $request['delivery'] = [
            'cityId'=>$this->shipment->getReceiver()
        ];


        // город отправления
        $request['pickup'] = [
            'cityId'=>$this->shipment->getSender()
        ];

        // код услуги DPD
        if ($serviceCode = $this->shipment->getServiceCode()) {
            $request['serviceCode'] = $serviceCode;
        }

        $request['selfDelivery'] = $this->shipment->getSelfDelivery();
        $request['selfPickup'] = $this->shipment->getPickup();

        $request['weight'] = $this->shipment->getItemsWeight();

        // объявленная ценность груза: общая стоимость товаров
        $request['declaredValue'] = $this->shipment->getItemsCost();

        return $request;
    }

    public function getDeliveryCost()
    {
        $request = $this->commonRequest();
        $response = $this->client->execute('getServiceCost2', $request, 'request');

        return new Cost($response);
    }

    public function getDeliveryCostByParcels()
    {
        $request = $this->commonRequest();
        $request['parcel'] = $this->shipment->getItems();
        $response = $this->client->execute('getServiceCostByParcels2', $request, 'request');

        return new Cost($response);
    }

    public function getDeliveryCostInternational()
    {

    }



}