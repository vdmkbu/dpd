<?php

namespace Vdmkbu\Dpd;


class Cost
{
    protected $calculated_data;

    public function __construct(\StdClass $calculated_data)
    {
        $this->calculated_data = $calculated_data;
    }

    public function getCostByCode($code)
    {
        foreach($this->calculated_data->return as $calc_id => $calc_data) {
            if($calc_data->serviceCode == $code) {
                return $calc_data->cost;
            }
        }
    }

    public function getDaysByCode($code)
    {
        foreach($this->calculated_data->return as $calc_id => $calc_data) {
            if($calc_data->serviceCode == $code) {
                return $calc_data->days;
            }
        }
    }

    public function getNameByCode($code)
    {
        foreach($this->calculated_data->return as $calc_id => $calc_data) {
            if($calc_data->serviceCode == $code) {
                return $calc_data->serviceName;
            }
        }
    }
}