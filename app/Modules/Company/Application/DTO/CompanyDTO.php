<?php

declare(strict_types=1);

namespace App\Modules\Company\Application\DTO;

use App\Modules\Company\Domain\Entity\Company;

class CompanyDTO
{
    public function mapData(Company $company): array
    {
        return [
            'Name' => $company->getName(),
            'Street Address' => $company->getStreet(),
            'City' => $company->getCity(),
            'Zip code' => $company->getZip(),
            'Phone' => $company->getPhone(),
            'email' => $company->getEmail(),
        ];
    }
}
