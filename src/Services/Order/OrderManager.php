<?php

namespace Vdmkbu\Dpd\Services\Order;


use Vdmkbu\Dpd\API\ClientFactory;
use Vdmkbu\Dpd\Config;

class OrderManager
{
    protected $client;
    protected $order;

    public function __construct(Order $order, Config $config)
    {
        $wsdl = "order2?wsdl";
        $this->order = $order;
        $this->client = ClientFactory::create($wsdl, $config);
    }

    public function create()
    {
        $request['header'] = [
            'datePickup' => $this->order->getDatePickup(),
            'senderAddress' => [
                'name' => $this->order->getSenderName(),
                'countryName' => $this->order->getSenderCountryName(),
                'city' => $this->order->getSenderCity(),
                'street' => $this->order->getSenderStreet(),
                'streetAbbr' => $this->order->getSenderStreetAbbr(),
                'house' => $this->order->getSenderHouse(),
                'contactFio' => $this->order->getSenderFio(),
                'contactPhone' => $this->order->getSenderPhone()
            ],
            'pickupTimePeriod' => $this->order->getPickupTimePeriod(),
            'payer' => $this->order->getPayer()
        ];

        $request['order'] = [
            'orderNumberInternal' => $this->order->getOrderNumberInternal(),
            'serviceCode' => $this->order->getServiceCode(),
            'serviceVariant' => $this->order->getServiceVariant(),
            'cargoNumPack' => $this->order->getCargoNumPack(),
            'cargoWeight' => $this->order->getCargoWeight(),
            'cargoRegistered' => $this->order->getCargoRegistered(),
            'cargoCategory' => $this->order->getCargoCategory(),
            'receiverAddress' => [
                'name' => $this->order->getReceiverName(),
                'countryName' => $this->order->getReceiverCountryName(),
                'city' => $this->order->getReceiverCity(),
                'street' => $this->order->getReceiverStreet(),
                'streetAbbr' => $this->order->getReceiverStreetAbbr(),
                'house' => $this->order->getReceiverHouse(),
                'contactFio' => $this->order->getReceiverFio(),
                'contactPhone' => $this->order->getReceiverPhone()
            ]
        ];

        // TODO: возвращаемый тип и методы getOrderNum, getStatus, getOrderNumInternal
        return $this->client->execute('createOrder', $request, 'orders');
    }

    public function cancel()
    {

    }
}