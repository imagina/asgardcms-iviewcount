<?php

namespace Modules\Iviewcounts\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Log;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Iviewcounts\Http\Requests\CreateCountRequest;
use Modules\Iviewcounts\Repositories\CountRepository;
use Modules\Iviewcounts\Transformer\CountTransformer;
use Route;

class CountController extends BaseApiController
{
    public $count;

    public function __construct(CountRepository $count)
    {
        $this->count = $count;
    }

    /**
     * GET ITEMS
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->count->getItemsBy($params);

            //Response
            $response = ["data" => CountTransformer::collection($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * GET A ITEM
     *
     * @param $criteria
     * @return mixed
     */
    public function show($criteria, Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->count->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Response
            $response = ["data" => new CountTransformer($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    public function count(Request $request)
    {

        try {
            $params = (object)$request->input('attributes');
            //Request to Repository
            $dataEntity = $this->count->getByEntity($params->entity, $params->entity_id);

            //Break if no found item
            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Response
            $response = ["data" => new CountTransformer($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

//Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * CREATE A ITEM
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = $request->input('attributes') ?? [];//Get data
            //Validate Request
            $count = $this->count->getByEntity($data['entity'], $data['entity_id']);
            $this->validateRequestApi(new CreateCountRequest($data));
            if (isset($count) && !empty($count)) {
                $data['value'] = $count->value + 1;
                $dataEntity = $this->count->update($count, $data);
            } else {
                $data['value'] = 1;
                //Create item
                $dataEntity = $this->count->create($data);
            }

            //Response
            $response = ["data" => new CountTransformer($dataEntity)];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

}