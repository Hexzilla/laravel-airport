<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomCountryRequest;
use App\Http\Requests\UpdateSomCountryRequest;
use App\Repositories\SomCountryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomCountryController extends AppBaseController
{
    /** @var  SomCountryRepository */
    private $somCountryRepository;

    public function __construct(SomCountryRepository $somCountryRepo)
    {
        $this->somCountryRepository = $somCountryRepo;
    }

    /**
     * Display a listing of the SomCountry.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somCountries = $this->somCountryRepository->all();

        return view('som_countries.index')
            ->with('somCountries', $somCountries);
    }

    /**
     * Show the form for creating a new SomCountry.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_countries.create');
    }

    /**
     * Store a newly created SomCountry in storage.
     *
     * @param CreateSomCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateSomCountryRequest $request)
    {
        $input = $request->all();

        $somCountry = $this->somCountryRepository->create($input);

        Flash::success('Som Country saved successfully.');

        return redirect(route('somCountries.index'));
    }

    /**
     * Display the specified SomCountry.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }

        return view('som_countries.show')->with('somCountry', $somCountry);
    }

    /**
     * Show the form for editing the specified SomCountry.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }

        return view('som_countries.edit')->with('somCountry', $somCountry);
    }

    /**
     * Update the specified SomCountry in storage.
     *
     * @param int $id
     * @param UpdateSomCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomCountryRequest $request)
    {
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }

        $somCountry = $this->somCountryRepository->update($request->all(), $id);

        Flash::success('Som Country updated successfully.');

        return redirect(route('somCountries.index'));
    }

    /**
     * Remove the specified SomCountry from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }

        $this->somCountryRepository->delete($id);

        Flash::success('Som Country deleted successfully.');

        return redirect(route('somCountries.index'));
    }
}
