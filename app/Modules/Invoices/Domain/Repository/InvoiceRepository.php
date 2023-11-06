<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Repository;

use App\Modules\Invoices\Domain\Entity\Invoice;

class InvoiceRepository
{
    public function getById($id): ?Invoice
    {
        return Invoice::find($id);
    }

    public function save(Invoice $invoice): bool
    {
        return $invoice->save();
    }
}
