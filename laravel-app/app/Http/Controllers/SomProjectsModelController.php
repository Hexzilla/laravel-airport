<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsModelRequest;
use App\Http\Requests\UpdateSomProjectsModelRequest;
use App\Repositories\SomProjectsModelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsModelController extends AppBaseController
{
    /** @var  SomProjectsModelRepository */
    private $somProjectsModelRepository;

    public function __construct(SomProjectsModelRepository $somProjectsModelRepo)
    {
        $this->somProjectsModelRepository = $somProjectsModelRepo;
    }

    /**
     * Display a listing of the SomProjectsModel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
        $somProjectsModels = $this->somProjectsModelRepository->all();

        return view('som_projects_models.index')
            ->with('somProjectsModels', $somProjectsModels);
    }

    /**
     * Show the form for creating a new SomProjectsModel.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects_models.create');
    }

    /**
     * Store a newly created SomProjectsModel in storage.
     *
     * @param CreateSomProjectsModelRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsModelRequest $request)
    {
        $input = $request->all();

        $somProjectsModel = $this->somProjectsModelRepository->create($input);

        Flash::success('Som Projects Model saved successfully.');

        return redirect(route('somProjectsModels.index'));
    }

    /**
     * Display the specified SomProjectsModel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsModel = $this->somProjectsModelRepository->find($id);

        if (empty($somProjectsModel)) {
            Flash::error('Som Projects Model not found');

            return redirect(route('somProjectsModels.index'));
        }

        return view('som_projects_models.show')->with('somProjectsModel', $somProjectsModel);
    }

    /**
     * Show the form for editing the specified SomProjectsModel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsModel = $this->somProjectsModelRepository->find($id);

        if (empty($somProjectsModel)) {
            Flash::error('Som Projects Model not found');

            return redirect(route('somProjectsModels.index'));
        }

        return view('som_projects_models.edit')->with('somProjectsModel', $somProjectsModel);
    }

    /**
     * Update the specified SomProjectsModel in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsModelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsModelRequest $request)
    {
        $somProjectsModel = $this->somProjectsModelRepository->find($id);

        if (empty($somProjectsModel)) {
            Flash::error('Som Projects Model not found');

            return redirect(route('somProjectsModels.index'));
        }

        $somProjectsModel = $this->somProjectsModelRepository->update($request->all(), $id);

        Flash::success('Som Projects Model updated successfully.');

        return redirect(route('somProjectsModels.index'));
    }

    /**
     * Remove the specified SomProjectsModel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsModel = $this->somProjectsModelRepository->find($id);

        if (empty($somProjectsModel)) {
            Flash::error('Som Projects Model not found');

            return redirect(route('somProjectsModels.index'));
        }

        $this->somProjectsModelRepository->delete($id);

        Flash::success('Som Projects Model deleted successfully.');

        return redirect(route('somProjectsModels.index'));
    }
}
