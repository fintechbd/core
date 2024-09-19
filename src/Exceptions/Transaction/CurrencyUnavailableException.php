<?php

namespace Fintech\Core\Exceptions\Transaction;

use Exception;
use Fintech\MetaData\Facades\MetaData;
use Throwable;

/**
 * Class CurrencyUnavailableException
 */
class CurrencyUnavailableException extends Exception
{
    /**
     * CurrencyUnavailableException constructor.
     *
     * @param $countryId
     * @param Throwable|null $previous
     */
    public function __construct($countryId, ?Throwable $previous = null)
    {
        $currency = MetaData::currency()->find($countryId);

        $message = __('core::messages.transaction.currency_unavailable', ['slug' => "{$currency->name}({$currency->code})"]);

        parent::__construct($message, 0, $previous);
    }
}
