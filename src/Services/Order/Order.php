<?php

namespace Vdmkbu\Dpd\Services\Order;


use Vdmkbu\Dpd\Config;

class Order
{
    protected $datePickup;
    protected $senderName;
    protected $senderCountryName;
    protected $senderCity;
    protected $senderStreet;
    protected $senderStreetAbbr;
    protected $senderHouse;
    protected $senderFio;
    protected $senderPhone;
    protected $pickupTimePeriod;
    protected $payer;
    protected $orderNumberInternal;
    protected $serviceCode;
    protected $serviceVariant;
    protected $cargoNumPack;
    protected $cargoWeight;
    protected $cargoRegistered;
    protected $cargoCategory;
    protected $receiverName;
    protected $receiverCountryName;
    protected $receiverCity;
    protected $receiverStreet;
    protected $receiverStreetAbbr;
    protected $receiverHouse;
    protected $receiverFio;
    protected $receiverPhone;

    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function manage()
    {
        return new OrderManager($this, $this->config);
    }
    public function setDatePickup($datePickup)
    {
        $this->datePickup = $datePickup;
        return $this;
    }

    public function setSenderName($senderName)
    {
        $this->senderName = $senderName;
        return $this;
    }

    public function setSenderCountryName($senderCountryName)
    {
        $this->senderCountryName = $senderCountryName;
        return $this;
    }

    public function setSenderCity($senderCity)
    {
        $this->senderCity = $senderCity;
        return $this;
    }

    public function setSenderStreet($senderStreet)
    {
        $this->senderStreet = $senderStreet;
        return $this;

    }

    public function setSenderStreetAbbr($senderStreetAbbr)
    {
        $this->senderStreetAbbr = $senderStreetAbbr;
        return $this;
    }

    public function setSenderHouse($senderHouse)
    {
        $this->senderHouse = $senderHouse;
        return $this;
    }

    public function setSenderFio($senderFio)
    {
        $this->senderFio = $senderFio;
        return $this;
    }

    public function setSenderPhone($senderPhone)
    {
        $this->senderPhone = $senderPhone;
        return $this;
    }

    public function setPickupTimePeriod($pickupTimePeriod)
    {
        $this->pickupTimePeriod = $pickupTimePeriod;
        return $this;
    }

    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }

    public function setOrderNumberInternal($orderNumberInternal)
    {
        $this->orderNumberInternal = $orderNumberInternal;
        return $this;
    }

    public function setServiceCode($serviceCode)
    {
        $this->serviceCode = $serviceCode;
        return $this;
    }

    public function setServiceVariant($serviceVariant)
    {
        $this->serviceVariant = $serviceVariant;
        return $this;
    }

    public function setCargoNumPack($cargoNumPack)
    {
        $this->cargoNumPack = $cargoNumPack;
        return $this;
    }

    public function setCargoWeight($cargoWeight)
    {
        $this->cargoWeight = $cargoWeight;
        return $this;
    }

    public function setCargoRegistered($cargoRegistered)
    {
        $this->cargoRegistered = $cargoRegistered;
        return $this;
    }

    public function setCargoCategory($cargoCategory)
    {
        $this->cargoCategory = $cargoCategory;
        return $this;
    }

    public function setReceiverName($receiverName)
    {
        $this->receiverName = $receiverName;
        return $this;
    }

    public function setReceiverCountryName($receiverCountryName)
    {
        $this->receiverCountryName = $receiverCountryName;
        return $this;
    }

    public function setReceiverCity($receiverCity)
    {
        $this->receiverCity = $receiverCity;
        return $this;
    }

    public function setReceiverStreet($receiverStreet)
    {
        $this->receiverStreet = $receiverStreet;
        return $this;
    }

    public function setReceiverStreetAbbr($receiverStreetAbbr)
    {
        $this->receiverStreetAbbr = $receiverStreetAbbr;
        return $this;
    }

    public function setReceiverHouse($receiverHouse)
    {
        $this->receiverHouse = $receiverHouse;
        return $this;
    }

    public function setReceiverFio($receiverFio)
    {
        $this->receiverFio = $receiverFio;
        return $this;
    }

    public function setReceiverPhone($receiverPhone)
    {
        $this->receiverPhone = $receiverPhone;
        return $this;
    }

    public function getDatePickup()
    {
        return $this->datePickup;
    }

    public function getSenderName()
    {
        return $this->senderName;
    }

    public function getSenderCountryName()
    {
        return $this->senderCountryName;
    }

    public function getSenderCity()
    {
        return $this->senderCity;
    }

    public function getSenderStreet()
    {
        return $this->senderStreet;
    }

    public function getSenderStreetAbbr()
    {
        return $this->senderStreetAbbr;
    }

    public function getSenderHouse()
    {
        return $this->senderHouse;
    }

    public function getSenderFio()
    {
        return $this->senderFio;
    }

    public function getSenderPhone()
    {
        return $this->senderPhone;
    }

    public function getPickupTimePeriod()
    {
        return $this->pickupTimePeriod;
    }

    public function getPayer()
    {
        return $this->payer;
    }

    public function getOrderNumberInternal()
    {
        return $this->orderNumberInternal;
    }

    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    public function getServiceVariant()
    {
        return $this->serviceVariant;
    }

    public function getCargoNumPack()
    {
        return $this->cargoNumPack;
    }

    public function getCargoWeight()
    {
        return $this->cargoWeight;
    }

    public function getCargoRegistered()
    {
        return $this->cargoRegistered;
    }

    public function getCargoCategory()
    {
        return $this->cargoCategory;
    }

    public function getReceiverName()
    {
        return $this->receiverName;
    }

    public function getReceiverCountryName()
    {
        return $this->receiverCountryName;
    }

    public function getReceiverCity()
    {
        return $this->receiverCity;
    }


    public function getReceiverStreet()
    {
        return $this->receiverStreet;
    }

    public function getReceiverStreetAbbr()
    {
        return $this->receiverStreetAbbr;
    }

    public function getReceiverHouse()
    {
        return $this->receiverHouse;
    }

    public function getReceiverFio()
    {
        return $this->receiverFio;
    }

    public function getReceiverPhone()
    {
        return $this->receiverPhone;
    }




}