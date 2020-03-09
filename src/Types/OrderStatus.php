<?php

namespace Vdmkbu\Dpd\Types;


class OrderStatus
{
    protected $status;

    public function __construct(\StdClass $status)
    {
        $this->status = $status;
    }

    public function getOrderNum()
    {
        return $this->status->return->orderNum;
    }

    public function getStatus()
    {
        return $this->status->return->status;
    }

    public function getOrderNumInternal()
    {
        return $this->status->return->orderNumberInternal;
    }
}