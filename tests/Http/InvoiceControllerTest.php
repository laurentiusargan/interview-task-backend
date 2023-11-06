<?php

namespace Tests\Http;

use App\Http\Controllers\InvoiceController;
use App\Modules\Invoices\Domain\Service\InvoiceService;
use Illuminate\Http\JsonResponse;
use PHPUnit\Framework\TestCase;
class InvoiceControllerTest extends TestCase
{
    protected InvoiceService $mockInvoiceService;
    protected JsonResponse $mockJsonResponse;

    protected function setUp(): void
    {
        $this->mockInvoiceService = $this->createMock(InvoiceService::class);
        $this->mockJsonResponse = $this->createMock(JsonResponse::class);
    }

    public function testGetInvoice()
    {
        $invoiceId = '123';
        $controller = new InvoiceController($this->mockInvoiceService, $this->mockJsonResponse);

        $this->mockInvoiceService->expects($this->once())
            ->method('getData')
            ->with($invoiceId)
            ->willReturn(['id' => $invoiceId, 'status' => 'draft']);

        $this->mockJsonResponse->expects($this->once())
            ->method('setData')
            ->with(['id' => $invoiceId, 'status' => 'draft']);

        $response = $controller->getInvoice($invoiceId);
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    public function testApproveInvoice()
    {
        $invoiceId = '456';
        $controller = new InvoiceController($this->mockInvoiceService, $this->mockJsonResponse);

        $this->mockInvoiceService->expects($this->once())
            ->method('approve')
            ->with($invoiceId)
            ->willReturn(['id' => $invoiceId, 'status' => 'approved']);

        $this->mockJsonResponse->expects($this->once())
            ->method('setData')
            ->with(['id' => $invoiceId, 'status' => 'approved']);

        $response = $controller->approveInvoice($invoiceId);
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    public function testRejectInvoice()
    {
        $invoiceId = '789';
        $controller = new InvoiceController($this->mockInvoiceService, $this->mockJsonResponse);

        $this->mockInvoiceService->expects($this->once())
            ->method('reject')
            ->with($invoiceId)
            ->willReturn(['id' => $invoiceId, 'status' => 'rejected']);

        $this->mockJsonResponse->expects($this->once())
            ->method('setData')
            ->with(['id' => $invoiceId, 'status' => 'rejected']);

        $response = $controller->rejectInvoice($invoiceId);
        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
