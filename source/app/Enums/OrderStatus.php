<?php


namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self opened()
 * @method static self closed()
 * @method static self inProgress()
 * @method static self reserved()
 * @method static self pendingItResource()
 * @method static self pendingCustomerResponse()
 * @method static self committed()
 * @method static self canceled()
 */
class OrderStatus extends Enum
{
    protected static function values(): array
    {
        return [
            'opened' => 'opened',
            'closed' => 'closed',
            'inProgress' => 'in progress',
            'reserved' => 'reserved',
            'pendingItResource' => 'pending it resource',
            'pendingCustomerResponse' => 'pending customer response',
            'committed' => 'committed',
            'canceled' => 'canceled',
        ];
    }
}