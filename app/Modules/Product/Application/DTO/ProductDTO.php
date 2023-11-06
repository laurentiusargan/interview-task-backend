<?php

declare(strict_types=1);

namespace App\Modules\Product\Application\DTO;

use App\Modules\Product\Domain\Entity\Product;

class ProductDTO
{
    public function mapData(Product $product): array
    {

        dd($product);
        return [
            'Name' => $product->getName(),
            'Quantity' => $product['pivot']['quantity'] ?? '',
            'Unit Price' => $product->getPrice(),
            'Total' => $product->getTotal(),
        ];
    }
}
