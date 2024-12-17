<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IntegerConverterInterface
{
    public function convertInteger(int $number): string;
    public function getRecentConversion(): LengthAwarePaginator;
    public function getTopTenConversion(): Collection;
}
