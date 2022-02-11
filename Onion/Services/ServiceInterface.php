<?php


namespace Onion\Services;


interface ServiceInterface
{
    public function create($model, array $data);

    public function update($model, array $data);

    public function delete($model);
}
