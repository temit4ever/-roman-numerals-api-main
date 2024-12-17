<?php

namespace App\Actions;

use App\Services\Contracts\IntegerConverterService;
use Illuminate\Database\Eloquent\Collection;

class RetrieveTopTenConversionAction
{
    public function __construct(protected IntegerConverterService $integerConverterService,){}

    public function execute(): Collection
    {
        return $this->integerConverterService->getTopTenConversion();
    }
}
