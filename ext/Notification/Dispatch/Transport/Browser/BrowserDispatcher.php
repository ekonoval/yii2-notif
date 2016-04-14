<?php
namespace app\ext\Notification\Dispatch\Transport\Browser;

use app\ext\Notification\Dispatch\DispatchException;
use app\ext\Notification\Dispatch\Transport\TransportBase;
use app\models\User;

class BrowserDispatcher extends TransportBase
{
    public function performDispatch()
    {
        /** @var User $receiver */
        foreach ($this->dispatchData->receivers as $receiver) {
            $textDataContainer = $this->getTextDataContainer($receiver);
        }
    }

}
