<?php


namespace Onion\Services;


class InertiaService implements ServiceInterface
{
    public function create($model, array $data)
    {
        return $model->query()->create($data);
    }

    public function update($model, array $data)
    {
        return $model->query()->update($data);
    }

    public function delete($model)
    {
        return $model->delete();
    }
}
