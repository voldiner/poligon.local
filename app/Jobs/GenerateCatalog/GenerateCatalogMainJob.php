<?php

namespace App\Jobs\GenerateCatalog;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateCatalogMainJob extends AbstractJob
{

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->debug('start');

        // Кешируем продукты
        GenerateCatalogCacheJob::dispatchNow();

        // Создаем цепочку заданий формирования файлов с ценами
        $chainPrices = $this->getChainPrices();
        // Основные подзадачи
        $chainMain = [
            new GenerateCategoriesJob(),
            new GenerateDeliveriesJob(),
            new GeneratePointsJob(),
        ];
        // Подзадачи, которые выполняются последними
        $chainLast = [
          new ArchiveUploadsJob(),
          new SendPriceRequestJob(),
        ];
        $chain = array_merge($chainPrices, $chainMain, $chainLast);

        GenerateGoodsFileJob::withChain($chain)->dispatch();

        $this->debug('finish');
    }

    /**
     * формирование цепочек подзадач для генерации файлов с ценами
     * @return array
     */
    public function getChainPrices()
    {
        $result = [];
        $products = collect([1,2,3,4,5]);
        $fileNum = 1;

        foreach ($products->chunk(1) as $chunk){
            $result[] = new GeneratePricesFileChunkJob($chunk, $fileNum);
            $fileNum++;
        }

        return $result;

    }
}
