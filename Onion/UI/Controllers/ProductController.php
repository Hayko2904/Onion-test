<?php


namespace Onion\UI\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Onion\Domains\Product;
use Onion\Repository\ControllerServiceInterface;

class ProductController extends Controller
{
    /**
     * @var ControllerServiceInterface
     */
    private $controllerService;

    /**
     * ProductController constructor.
     * @param ControllerServiceInterface $controllerServiceInterface
     */
    public function __construct(ControllerServiceInterface $controllerServiceInterface)
    {
        $this->controllerService = $controllerServiceInterface;
    }

    /**
     * @param Request $request
     * Create product
     * @return object
     */
    public function create(Request $request) : object
    {
        $validate = Validator::make($request->toArray(), [
            'title' => 'required|string'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()
            ]);
        }

        return $this->controllerService->doCreate($request, Product::class);
    }

    /**
     * @param Request $request
     * @param Product $product
     * Update product
     * @return object
     */
    public function update(Request $request, Product $product): object
    {
        $validate = Validator::make($request->toArray(), [
            'title' => 'required|string'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()
            ]);
        }

        return $this->controllerService->doUpdate($request, $product, function ($product) use ($request) {
            try {
                $product->update($request->toArray());

                return response()->json([
                    'success' => true,
                    'result' => $product
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        });
    }

    /**
     * @param Product $product
     * Delete product
     * @return object
     */
    public function delete(Product $product) : object
    {
        return $this->controllerService->doDelete($product);
    }
}
