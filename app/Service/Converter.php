<?php

namespace App\Service;

use App\Models\Exchange;
use Carbon\Carbon;

class Converter
{
    /**
     * @return array
     */
    public function getExchanges(): array
    {
        return Exchange::query()
            ->whereDate('created_at', '=', Carbon::today()->format('Y-m-d'))
            ->get()
            ->toArray();
    }

    public function convert(string $from, string $to)
    {
        return Exchange::query()
            ->whereFrom($from)
            ->whereTo($to)
            ->whereDate('created_at', '=', Carbon::today()->format('Y-m-d'))
            ->get()
            ->toArray();
    }
}
