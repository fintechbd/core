<?php

namespace Fintech\Core\Exceptions\Transaction;

use Exception;
use Fintech\MetaData\Facades\MetaData;
use Throwable;

/**
 * Class CurrencyUnavailableException
 */
class MasterCurrencyUnavailableException extends Exception
{
    /**
     * CurrencyUnavailableException constructor.
     *
     * @param $countryId
     * @param Throwable|null $previous
     */
    public function __construct($countryId, ?Throwable $previous = null)
    {
        $currency = (is_numeric($countryId))
            ? MetaData::currency()->find($countryId)->code
            : $countryId;

        $message = __('core::messages.transaction.master_currency_unavailable', ['slug' => $currency]);

        parent::__construct($message, 0, $previous);
    }
}
