<?php
declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\EventListeners;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\Events\EntityRejected;
use App\Modules\Invoices\Domain\Entity\Invoice;

class EntityRejectedListener
{
    public function handle(EntityRejected $event): void
    {
        $approvalDto = $event->approvalDto;
        $entity = Invoice::findOrFail($approvalDto->id);
        $entity->status = StatusEnum::REJECTED->value;
        $entity->save();
    }
}
