<?php

namespace App\Actions;

use App\Services\Contracts\IntegerConverterService;
use Illuminate\Pagination\LengthAwarePaginator;

class RetrieveRecentConversionAction
{
    public function __construct(protected IntegerConverterService $integerConverterService,){}

    public function execute(): LengthAwarePaginator
    {
        return $this->integerConverterService->getRecentConversion();
    }
}
