<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormsRequest;
use App\Http\Requests\UpdateSomFormsRequest;
use App\Repositories\SomFormsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomFormsController extends AppBaseController
{
    /** @var  SomFormsRepository */
    private $somFormsRepository;

    public function __construct(SomFormsRepository $somFormsRepo)
    {
        $this->somFormsRepository = $somFormsRepo;
    }

    /**
     * Display a listing of the SomForms.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $milestones_id = $request->get('milestones_id');
        if( !empty($milestones_id) )
            $somForms = $this->somFormsRepository->all(['som_phases_milestones_id'=>$milestones_id]);
        else
            $somForms = $this->somFormsRepository->all();

        return view('som_forms.index')
            ->with('somForms', $somForms);
    }

    /**
     * Show the form for creating a new SomForms.
     *
     * @return Response
     */
    public function create()
    {
        $somForms = $this->somFormsRepository->all();
        return view('som_forms.create')
            ->with('somForms', $somForms);
    }

    /**
     * Store a newly created SomForms in storage.
     *
     * @param CreateSomFormsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomFormsRequest $request)
    {
        $input = $request->all();

        $somForms = $this->somFormsRepository->create($input);

        Flash::success('Som Forms saved successfully.');

        return redirect(route('somForms.index'));
    }

    /**
     * Display the specified SomForms.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }

        return view('som_forms.show')->with('somForms', $somForms);
    }

    /**
     * Show the form for editing the specified SomForms.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }

        return view('som_forms.edit')->with('somForms', $somForms);
    }

    /**
     * Update the specified SomForms in storage.
     *
     * @param int $id
     * @param UpdateSomFormsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomFormsRequest $request)
    {
        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }

        $somForms = $this->somFormsRepository->update($request->all(), $id);

        Flash::success('Som Forms updated successfully.');

        return redirect(route('somForms.index'));
    }

    /**
     * Remove the specified SomForms from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }

        $this->somFormsRepository->delete($id);

        Flash::success('Som Forms deleted successfully.');

        return redirect(route('somForms.index'));
    }
}
