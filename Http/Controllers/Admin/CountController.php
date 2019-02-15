<?php

namespace Modules\Iviewcounts\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iviewcounts\Entities\Count;
use Modules\Iviewcounts\Http\Requests\CreateCountRequest;
use Modules\Iviewcounts\Http\Requests\UpdateCountRequest;
use Modules\Iviewcounts\Repositories\CountRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CountController extends AdminBaseController
{
    /**
     * @var CountRepository
     */
    private $count;

    public function __construct(CountRepository $count)
    {
        parent::__construct();

        $this->count = $count;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$counts = $this->count->all();

        return view('iviewcounts::admin.counts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iviewcounts::admin.counts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCountRequest $request
     * @return Response
     */
    public function store(CreateCountRequest $request)
    {
        $this->count->create($request->all());

        return redirect()->route('admin.iviewcounts.count.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iviewcounts::counts.title.counts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Count $count
     * @return Response
     */
    public function edit(Count $count)
    {
        return view('iviewcounts::admin.counts.edit', compact('count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Count $count
     * @param  UpdateCountRequest $request
     * @return Response
     */
    public function update(Count $count, UpdateCountRequest $request)
    {
        $this->count->update($count, $request->all());

        return redirect()->route('admin.iviewcounts.count.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iviewcounts::counts.title.counts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Count $count
     * @return Response
     */
    public function destroy(Count $count)
    {
        $this->count->destroy($count);

        return redirect()->route('admin.iviewcounts.count.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iviewcounts::counts.title.counts')]));
    }
}
