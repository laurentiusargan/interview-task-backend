<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Invoices\Domain\Service\InvoiceService;
use App\Infrastructure\Controller;
use Illuminate\Http\JsonResponse;

class InvoiceController extends Controller
{
    public function __construct(
        protected InvoiceService $invoiceService,
        protected JsonResponse   $response
    )
    {
    }

    public function getInvoice(string $invoiceId): JsonResponse
    {
        $invoiceData = $this->invoiceService->getData($invoiceId);
        return $this->response->setData($invoiceData);
    }

    public function approveInvoice(string $invoiceId): JsonResponse
    {
        $approveInvoice = $this->invoiceService->approve($invoiceId);
        return $this->response->setData($approveInvoice);
    }

    public function rejectInvoice(string $invoiceId): JsonResponse
    {
        $rejectInvoice = $this->invoiceService->reject($invoiceId);
        return $this->response->setData($rejectInvoice);
    }
}