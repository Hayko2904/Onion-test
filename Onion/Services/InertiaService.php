<?php


namespace Onion\Services;


class InertiaService implements ServiceInterface
{
    /**
     * @param $model
     * @param array $data
     * @return mixed
     */
    public function create($model, array $data)
    {
        return $model->query()->create($data);
    }

    /**
     * @param $model
     * @param array $data
     * @return mixed
     */
    public function update($model, array $data)
    {
        return $model->query()->update($data);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model)
    {
        return $model->delete();
    }
}
