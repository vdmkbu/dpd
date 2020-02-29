<?php

namespace Vdmkbu\Dpd;


class Shipment
{
    protected $config;
    protected $sender_id;
    protected $receiver_id;
    protected $selfDelivery;
    protected $selfPickup;
    protected $serviceCode;
    protected $items;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function calculator()
    {
        return new Calculator($this, $this->config);
    }

    public function setSender($sender_id)
    {
        $this->sender_id = $sender_id;
    }

    public function setReceiver($receiver_id)
    {
        $this->receiver_id = $receiver_id;
    }

    public function setSelfDelivery($value)
    {
        $this->selfDelivery = $value;
    }

    public function setPickup($value)
    {
        $this->selfPickup = $value;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function setServiceCode($value)
    {
        $this->serviceCode = $value;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getItemsWeight()
    {
        $items = $this->getItems();
        //$weight = array_sum(array_column($items, 'weight')); //8
        return $items['weight'];

    }

    public function getItemsCost()
    {
        $items = $this->getItems();
        //$cost = array_sum(array_column($items, 'cost')); //470
        return $items['cost'];
    }

    public function getSelfDelivery()
    {
        return $this->selfDelivery;
    }

    public function getPickup()
    {
        return $this->selfPickup;
    }

    public function getSender()
    {
        return $this->sender_id;
    }

    public function getReceiver()
    {
        return $this->receiver_id;
    }

    public function getServiceCode()
    {
        return $this->serviceCode;
    }
}