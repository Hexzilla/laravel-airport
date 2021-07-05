<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectProcessTypeRequest;
use App\Http\Requests\UpdateSomProjectProcessTypeRequest;
use App\Repositories\SomProjectProcessTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectProcessTypeController extends AppBaseController
{
    /** @var  SomProjectProcessTypeRepository */
    private $somProjectProcessTypeRepository;

    public function __construct(SomProjectProcessTypeRepository $somProjectProcessTypeRepo)
    {
        $this->somProjectProcessTypeRepository = $somProjectProcessTypeRepo;
    }

    /**
     * Display a listing of the SomProjectProcessType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectProcessTypes = $this->somProjectProcessTypeRepository->all();

        return view('som_project_process_types.index')
            ->with('somProjectProcessTypes', $somProjectProcessTypes);
    }

    /**
     * Show the form for creating a new SomProjectProcessType.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_project_process_types.create');
    }

    /**
     * Store a newly created SomProjectProcessType in storage.
     *
     * @param CreateSomProjectProcessTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectProcessTypeRequest $request)
    {
        $input = $request->all();

        $somProjectProcessType = $this->somProjectProcessTypeRepository->create($input);

        Flash::success('Som Project Process Type saved successfully.');

        return redirect(route('somProjectProcessTypes.index'));
    }

    /**
     * Display the specified SomProjectProcessType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectProcessType = $this->somProjectProcessTypeRepository->find($id);

        if (empty($somProjectProcessType)) {
            Flash::error('Som Project Process Type not found');

            return redirect(route('somProjectProcessTypes.index'));
        }

        return view('som_project_process_types.show')->with('somProjectProcessType', $somProjectProcessType);
    }

    /**
     * Show the form for editing the specified SomProjectProcessType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectProcessType = $this->somProjectProcessTypeRepository->find($id);

        if (empty($somProjectProcessType)) {
            Flash::error('Som Project Process Type not found');

            return redirect(route('somProjectProcessTypes.index'));
        }

        return view('som_project_process_types.edit')->with('somProjectProcessType', $somProjectProcessType);
    }

    /**
     * Update the specified SomProjectProcessType in storage.
     *
     * @param int $id
     * @param UpdateSomProjectProcessTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectProcessTypeRequest $request)
    {
        $somProjectProcessType = $this->somProjectProcessTypeRepository->find($id);

        if (empty($somProjectProcessType)) {
            Flash::error('Som Project Process Type not found');

            return redirect(route('somProjectProcessTypes.index'));
        }

        $somProjectProcessType = $this->somProjectProcessTypeRepository->update($request->all(), $id);

        Flash::success('Som Project Process Type updated successfully.');

        return redirect(route('somProjectProcessTypes.index'));
    }

    /**
     * Remove the specified SomProjectProcessType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectProcessType = $this->somProjectProcessTypeRepository->find($id);

        if (empty($somProjectProcessType)) {
            Flash::error('Som Project Process Type not found');

            return redirect(route('somProjectProcessTypes.index'));
        }

        $this->somProjectProcessTypeRepository->delete($id);

        Flash::success('Som Project Process Type deleted successfully.');

        return redirect(route('somProjectProcessTypes.index'));
    }
}
