<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        $eliquentCollection = BlogPost::withTrashed()->get();

       // dd(__METHOD__, $eliquentCollection, $eliquentCollection->toArray());

        $collection = collect($eliquentCollection->toArray());

        $result[] = $collection->first();
        $result[] = $collection->last();
        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');
        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();
        $result['where_first'] = $collection->firstWhere('created_at', '>', '2019-01-17 01:35:11');
        // -- возвращает новую коллекцию
//        $result['map']['all'] = $collection->map(function (array $item){
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_name = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//            return $newItem;
//        });
//        $result['map']['not_exists'] = $result['map']['all']->where('exists', '=', false)->values()->keyBy('item_id');

        //трансформирует базовую
        $collection->transform(function ($item){
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);
            return $newItem;
        });

        /*$newItem = new \stdClass();
        $newItem->id =9999;
        $newItem2 = new \stdClass();
        $newItem2->id =8888;

        $newItemFirst = $collection->prepend($newItem)->first();
        $newItemLast = $collection->push($newItem2)->last();

        $pulledItem = $collection->push(1);
        */
        // фильтрация
        /*$filtered = $collection->filter(function ($item){
            $byDay = $item->created_at->isFriday();
            $byDate = $item->created_at->day == 11;

            $result = $byDay && $byDate;
        });*/


    }
}
