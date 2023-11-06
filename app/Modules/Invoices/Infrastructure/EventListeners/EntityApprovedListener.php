<?php
declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\EventListeners;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\Events\EntityApproved;
use App\Modules\Invoices\Domain\Entity\Invoice;

class EntityApprovedListener
{
    public function handle(EntityApproved $event): void
    {

        $approvalDto = $event->approvalDto;
        $entity = Invoice::findOrFail($approvalDto->id);
        $entity->status = StatusEnum::APPROVED->value;
        $entity->save();
    }
}
