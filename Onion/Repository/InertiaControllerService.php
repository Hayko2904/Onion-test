<?php


namespace Onion\Repository;


use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\DB;
use Onion\Services\ServiceInterface;

abstract class InertiaControllerService implements ControllerServiceInterface
{
    protected $modelClass;

    protected $serviceInterface;

    public function __construct(ServiceInterface $serviceInterface)
    {
        $this->serviceInterface = $serviceInterface;
    }

    public function doCreate(Request $request, $model, ?Closure $createMethod = null)
    {
        try {
            $this->modelClass = get_class($model);

            DB::beginTransaction();

            $result = is_null($createMethod)
                ? $this->serviceInterface->create($this->modelClass, $request->toArray())
                : $data = $createMethod($model);

            DB::commit();

            return response()->json([
                'result' => $result,
                'success' => true
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function doUpdate(Request $request, $model, ?Closure $updateMethod = null)
    {
        try {
            DB::beginTransaction();

            $result = is_null($updateMethod)
                ? $this->serviceInterface->update($model, $request->toArray())
                : $updateMethod($model);

            DB::commit();

            return response()->json([
                'result' => $result,
                'success' => true
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function doDelete($model, ?Closure $deleteMethod = null)
    {
        try {
            DB::beginTransaction();

            $result = is_null($deleteMethod)
                ? $this->serviceInterface->delete($model)
                : $deleteMethod($model);

            DB::commit();

            return response()->json([
                'success' => true,
                'result' => $result
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
