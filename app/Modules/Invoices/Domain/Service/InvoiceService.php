<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Service;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Invoices\Application\DTO\InvoiceDTO;
use App\Modules\Invoices\Application\DTO\ProductDTO;
use App\Modules\Invoices\Domain\Repository\InvoiceRepository;
use Ramsey\Uuid\Uuid;

class InvoiceService
{
    public function __construct(
        protected InvoiceRepository       $invoiceRepository,
        protected ApprovalFacadeInterface $approvalFacade,
        protected InvoiceDTO              $invoiceDataMapper,
    )
    {
    }

    public function getData(string $invoiceId): array
    {
        $invoice = $this->invoiceRepository->getById($invoiceId);
        if (!$invoice) {
            return [];
        }
        return $this->invoiceDataMapper->mapData($invoice, $invoiceId);
    }

    public function reject(string $invoiceId): bool
    {
        return $this->modifyStatus($invoiceId, StatusEnum::REJECTED, 'reject');
    }

    public function approve(string $invoiceId): bool
    {
        return $this->modifyStatus($invoiceId, StatusEnum::APPROVED, 'approve');
    }

    private function modifyStatus(string $invoiceId, StatusEnum $status, string $methodName): bool
    {
        $invoice = $this->invoiceRepository->getById($invoiceId);
        if (!$invoice) {
            return false;
        }

        if (StatusEnum::DRAFT === StatusEnum::tryFrom($invoice->status)) {
            $approvalDto = new ApprovalDto(
                Uuid::fromString($invoiceId),
                StatusEnum::tryFrom($invoice->status),
                'invoice'
            );
            return $this->approvalFacade->{$methodName}($approvalDto);
        }
        return false;
    }
}