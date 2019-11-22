<?php


namespace App\Api;


use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class ApiController extends Controller
{
    use Helpers;

    public function success($data = [], $message = '')
    {
        return $this->response->array(['error_code' => 0, 'data' => $data, 'message' => $message]);
    }
}
