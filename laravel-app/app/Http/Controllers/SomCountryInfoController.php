<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomCountryInfoRequest;
use App\Http\Requests\UpdateSomCountryInfoRequest;
use App\Repositories\SomCountryInfoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomCountryInfoController extends AppBaseController
{
    /** @var  SomCountryInfoRepository */
    private $somCountryInfoRepository;

    public function __construct(SomCountryInfoRepository $somCountryInfoRepo)
    {
        $this->somCountryInfoRepository = $somCountryInfoRepo;
    }

    /**
     * Display a listing of the SomCountryInfo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somCountryInfos = $this->somCountryInfoRepository->all();

        return view('som_country_infos.index')
            ->with('somCountryInfos', $somCountryInfos);
    }

    /**
     * Show the form for creating a new SomCountryInfo.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_country_infos.create');
    }

    /**
     * Store a newly created SomCountryInfo in storage.
     *
     * @param CreateSomCountryInfoRequest $request
     *
     * @return Response
     */
    public function store(CreateSomCountryInfoRequest $request)
    {
        $validated = $request->validated();

        if (array_key_exists('som_country_id', $validated)) {
            unset($validated['som_country_id']);
        }
        $somCountryInfo = $this->somCountryInfoRepository->create($validated);

        Flash::success('Som Country Info saved successfully.');

        return redirect(route('somCountryInfos.index'));
    }

    /**
     * Display the specified SomCountryInfo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        return view('som_country_infos.show')->with('somCountryInfo', $somCountryInfo);
    }

    /**
     * Show the form for editing the specified SomCountryInfo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        return view('som_country_infos.edit')->with('somCountryInfo', $somCountryInfo);
    }

    /**
     * Update the specified SomCountryInfo in storage.
     *
     * @param int $id
     * @param UpdateSomCountryInfoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomCountryInfoRequest $request)
    {
        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        $somCountryInfo = $this->somCountryInfoRepository->update($request->all(), $id);

        Flash::success('Som Country Info updated successfully.');

        return redirect(route('somCountryInfos.index'));
    }

    /**
     * Remove the specified SomCountryInfo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        $this->somCountryInfoRepository->delete($id);

        Flash::success('Som Country Info deleted successfully.');

        return redirect(route('somCountryInfos.index'));
    }
}
