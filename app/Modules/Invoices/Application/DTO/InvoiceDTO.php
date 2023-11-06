<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\DTO;

use App\Modules\Company\Application\DTO\CompanyDTO;
use App\Modules\Invoices\Domain\Entity\Invoice;
use App\Modules\Product\Application\DTO\ProductDTO;

class InvoiceDTO
{
    public function __construct(
        protected CompanyDTO $companyDataMapper,
        protected ProductDTO $productDataMapper,
    )
    {
    }

    public function mapData(Invoice $invoice, string $invoiceId): array
    {
        return [
            'Invoice number' => $invoice->getNumber(),
            'Invoice date' => $invoice->getDate(),
            'Due date' => $invoice->getDueDate(),
            'Status' => $invoice->getStatus(),

            'Company' => $this->companyDataMapper->mapData($invoice->company),
            'Billed company' => $this->companyDataMapper->mapData($invoice->billedCompany),
            'Products' => $this->parseMapProducts($invoice->products, $invoiceId),
            'Total price' => $invoice->getTotalAmountAttribute($invoiceId),
        ];
    }

    public function parseMapProducts($products, string $invoiceId): array
    {
        $productsData = [];
        foreach ($products as $product) {
            if ($product['pivot']['invoice_id'] === $invoiceId) {
                $productsData[] = $this->productDataMapper->mapData($product);
            }
        }
        return $productsData;
    }
}
