<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */

    protected function getModelClass()
    {
        return Model::class;
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

    /**
     * получить список категорий для вывода в выпадающем списке
     * @return Collection
     */
    public function getForComboBox()
    {
        //return $this->startConditions()->all();
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title'
        ]);
        $result = $this->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;
    }

    public function getAllWithPaginate($perPage = null)
    {
        $result = $this
            ->startConditions()
            ->select(['id', 'title', 'parent_id'])
            ->with('parentCategory:id,title')
            ->paginate($perPage);

        return $result;
    }

}