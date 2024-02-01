<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Exchange as ExchangeModel;
use FreeCurrencyApi\FreeCurrencyApi\FreeCurrencyApiClient;

class Exchange extends Command
{
    protected $freecurrencyapi;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:exchange';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Currencies receives and writes currency rates to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->freecurrencyapi = new FreeCurrencyApiClient(
            config('exchange.api-key')
        );

        $oldRates = ExchangeModel::query()
            ->whereDate('created_at', '=', Carbon::today()->format('Y-m-d'))
            ->get();

        if (empty($oldRates->get('items'))) {
            $currencies = config('exchange.currencies');
            foreach ($currencies as $currency) {
                $this->setRatesToDB($currency);
            }

        }

        $this->info('Success!');
    }

    protected function setRatesToDB($baseCurrency)
    {
        $currencies = config('exchange.currencies');
        $exchange = new ExchangeModel();
        foreach ($currencies as $currency) {
            if ($currency !== $baseCurrency) {
                $rate = $this->freecurrencyapi->latest([
                    'base_currency' => $baseCurrency,
                    'currencies' => $currency,
                ]);

                if (array_key_exists('data', $rate)) {
                    $exchange->create([
                        'from' => $baseCurrency,
                        'to' => $currency,
                        'rate' => $rate['data'][$currency]
                    ]);
                }
            }
        }
    }
}
