<?php


namespace Onion\Services;


interface ServiceInterface
{
    /**
     * @param $model
     * @param array $data
     * @return mixed
     */
    public function create($model, array $data);

    /**
     * @param $model
     * @param array $data
     * @return mixed
     */
    public function update($model, array $data);

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model);
}
