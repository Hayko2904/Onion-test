<?php


namespace Onion\Repository;

use Closure;
use Illuminate\Http\Request;

interface ControllerServiceInterface
{
    /**
     * @param Request $request
     * @param $model
     * @param Closure|null $createMethod
     * @return mixed
     */
    public function doCreate(Request $request, $model, ?Closure $createMethod = null);

    /**
     * @param Request $request
     * @param $model
     * @param Closure|null $updateMethod
     * @return mixed
     */
    public function doUpdate(Request $request, $model, ?Closure $updateMethod = null);

    /**
     * @param $model
     * @param Closure|null $deleteMethod
     * @return mixed
     */
    public function doDelete($model, ?Closure $deleteMethod = null);
}
