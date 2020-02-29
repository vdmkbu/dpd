<?php

namespace Vdmkbu\Dpd;


class Cost
{
    protected $calculated_data;

    public function __construct(\StdClass $calculated_data)
    {
        $this->calculated_data = $calculated_data;
    }

    public function getCalculatedData()
    {
        return $this->calculated_data;
    }

    // TODO: дублирование, рефакторинг
    public function getCostByCode($code)
    {
        $calculated_data = $this->calculated_data->return;

        // если передали несколько сервисов доставки (IND, PCL, etc), то проходим по массиву
        if (is_array($calculated_data)) {

            foreach($calculated_data as $calc_data) {

                if($calc_data->serviceCode == $code) {
                    return $calc_data->cost;
                }
            }

        }

        // если передели один сервис доставки, то вернем значение
        if (is_object($calculated_data)) {
            return $calculated_data->cost;
        }



    }

    public function getDaysByCode($code)
    {
        $calculated_data = $this->calculated_data->return;

        // если передали несколько сервисов доставки (IND, PCL, etc), то проходим по массиву
        if (is_array($calculated_data)) {

            foreach($calculated_data as $calc_data) {

                if($calc_data->serviceCode == $code) {
                    return $calc_data->days;
                }
            }

        }

        // если передели один сервис доставки, то вернем значение
        if (is_object($calculated_data)) {
            return $calculated_data->days;
        }
    }

    public function getNameByCode($code)
    {
        $calculated_data = $this->calculated_data->return;

        // если передали несколько сервисов доставки (IND, PCL, etc), то проходим по массиву
        if (is_array($calculated_data)) {

            foreach($calculated_data as $calc_data) {

                if($calc_data->serviceCode == $code) {
                    return $calc_data->serviceName;
                }
            }

        }

        // если передели один сервис доставки, то вернем значение
        if (is_object($calculated_data)) {
            return $calculated_data->serviceName;
        }

    }
}