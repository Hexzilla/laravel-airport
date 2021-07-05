<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAssetTypeRequest;
use App\Http\Requests\UpdateSomProjectsAssetTypeRequest;
use App\Repositories\SomProjectsAssetTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsAssetTypeController extends AppBaseController
{
    /** @var  SomProjectsAssetTypeRepository */
    private $somProjectsAssetTypeRepository;

    public function __construct(SomProjectsAssetTypeRepository $somProjectsAssetTypeRepo)
    {
        $this->somProjectsAssetTypeRepository = $somProjectsAssetTypeRepo;
    }

    /**
     * Display a listing of the SomProjectsAssetType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectsAssetTypes = $this->somProjectsAssetTypeRepository->all();

        return view('som_projects_asset_types.index')
            ->with('somProjectsAssetTypes', $somProjectsAssetTypes);
    }

    /**
     * Show the form for creating a new SomProjectsAssetType.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects_asset_types.create');
    }

    /**
     * Store a newly created SomProjectsAssetType in storage.
     *
     * @param CreateSomProjectsAssetTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsAssetTypeRequest $request)
    {
        $input = $request->all();

        $somProjectsAssetType = $this->somProjectsAssetTypeRepository->create($input);

        Flash::success('Som Projects Asset Type saved successfully.');

        return redirect(route('somProjectsAssetTypes.index'));
    }

    /**
     * Display the specified SomProjectsAssetType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsAssetType = $this->somProjectsAssetTypeRepository->find($id);

        if (empty($somProjectsAssetType)) {
            Flash::error('Som Projects Asset Type not found');

            return redirect(route('somProjectsAssetTypes.index'));
        }

        return view('som_projects_asset_types.show')->with('somProjectsAssetType', $somProjectsAssetType);
    }

    /**
     * Show the form for editing the specified SomProjectsAssetType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsAssetType = $this->somProjectsAssetTypeRepository->find($id);

        if (empty($somProjectsAssetType)) {
            Flash::error('Som Projects Asset Type not found');

            return redirect(route('somProjectsAssetTypes.index'));
        }

        return view('som_projects_asset_types.edit')->with('somProjectsAssetType', $somProjectsAssetType);
    }

    /**
     * Update the specified SomProjectsAssetType in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsAssetTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsAssetTypeRequest $request)
    {
        $somProjectsAssetType = $this->somProjectsAssetTypeRepository->find($id);

        if (empty($somProjectsAssetType)) {
            Flash::error('Som Projects Asset Type not found');

            return redirect(route('somProjectsAssetTypes.index'));
        }

        $somProjectsAssetType = $this->somProjectsAssetTypeRepository->update($request->all(), $id);

        Flash::success('Som Projects Asset Type updated successfully.');

        return redirect(route('somProjectsAssetTypes.index'));
    }

    /**
     * Remove the specified SomProjectsAssetType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsAssetType = $this->somProjectsAssetTypeRepository->find($id);

        if (empty($somProjectsAssetType)) {
            Flash::error('Som Projects Asset Type not found');

            return redirect(route('somProjectsAssetTypes.index'));
        }

        $this->somProjectsAssetTypeRepository->delete($id);

        Flash::success('Som Projects Asset Type deleted successfully.');

        return redirect(route('somProjectsAssetTypes.index'));
    }
}
