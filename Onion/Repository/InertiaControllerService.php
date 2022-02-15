<?php


namespace Onion\Repository;


use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\DB;
use Onion\Services\ServiceInterface;

class InertiaControllerService implements ControllerServiceInterface
{
    /**
     * @var Object Model
     */
    protected $modelClass;

    /**
     * @var ServiceInterface
     */
    protected $serviceInterface;

    /**
     * InertiaControllerService constructor.
     * @param ServiceInterface $serviceInterface
     */
    public function __construct(ServiceInterface $serviceInterface)
    {
        $this->serviceInterface = $serviceInterface;
    }

    /**
     * @param Request $request
     * @param $model
     * @param Closure|null $createMethod
     * @return \Illuminate\Http\JsonResponse
     */
    public function doCreate(Request $request, $model, ?Closure $createMethod = null)
    {
        try {
            $this->modelClass = new $model;

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

    /**
     * @param Request $request
     * @param $model
     * @param Closure|null $updateMethod
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param $model
     * @param Closure|null $deleteMethod
     * @return \Illuminate\Http\JsonResponse
     */
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
