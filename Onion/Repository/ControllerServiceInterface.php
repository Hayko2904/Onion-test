<?php


namespace Onion\Repository;

use Closure;
use Illuminate\Http\Request;

interface ControllerServiceInterface
{
    public function doCreate(Request $request, $model, ?Closure $createMethod = null);

    public function doUpdate(Request $request, $model, ?Closure $updateMethod = null);

    public function doDelete($model, ?Closure $deleteMethod = null);
}
