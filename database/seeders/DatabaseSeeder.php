<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Modules\Invoices\Infrastructure\Database\Seeders\CompanySeeder;
use App\Modules\Invoices\Infrastructure\Database\Seeders\InvoiceSeeder;
use App\Modules\Invoices\Infrastructure\Database\Seeders\ProductSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            CompanySeeder::class,
            InvoiceSeeder::class,
        ]);
    }
}
