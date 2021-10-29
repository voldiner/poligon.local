<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 16.10.2021
 * Time: 15:40
 */

namespace App\Repositories;
use App\Models\BlogPost as Model;


class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
    /**
     * получить список статей для вывода
     *  @return LengthAwarePaginator
     */

    public function getAllWithPaginate()
    {
        $result = $this
            ->startConditions()
            ->select(['id', 'title', 'slug', 'is_published', 'published_at', 'category_id', 'user_id'])
            ->orderBy('id', 'DESC')
            //->with(['user','category'])
                // нам нужны не все поля пользователя и категории
            ->with([
                'category' => function($query){
                                $query->select(['id', 'title']);
                                },
                // -- можно короче
                'user:id,name',
            ])
            ->paginate(25);

        return $result;
    }

    /**
     * получить модель для редактирования в админке
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }



}