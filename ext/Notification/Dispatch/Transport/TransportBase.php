<?php
namespace app\ext\Notification\Dispatch\Transport;

use app\ext\Notification\Dispatch\DispatchData;

class TransportBase
{
    /**
     * @var DispatchData
     */
    protected $dispatchData;

    public function __construct(DispatchData $dispatchData)
    {
        $this->dispatchData = $dispatchData;
        $this->init();
    }

    protected function init(){}

    public function process()
    {

    }

}
