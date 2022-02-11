<?php


namespace Onion\UI\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Onion\Domains\Item;
use Onion\Repository\ControllerServiceInterface;

class ItemController extends Controller
{
    private $controllerService;

    public function __construct(ControllerServiceInterface $controllerServiceInterface)
    {
        $this->controllerService = $controllerServiceInterface;
    }

    public function create(Request $request)
    {
        $validate = Validated::make($request->toArray(), [
            'title' => 'string'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->message()
            ]);
        }

        return $this->controllerService->doCreate($request, Item::class);
    }
}
