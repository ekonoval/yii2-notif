<?php
namespace app\ext\Notification\Placeholderable\Decorator;

interface ITextPlaceholderDecorator
{
    /**
     * Processes all placeholderable fields (at the moment `subject` and `body`)
     * by using any kind of decorators and filling TextDataContainer $textDataContainer field
     */
    public function prepareTextData();
}
