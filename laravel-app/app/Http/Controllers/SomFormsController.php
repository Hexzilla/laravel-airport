<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormsRequest;
use App\Http\Requests\UpdateSomFormsRequest;
use App\Repositories\SomFormsRepository;
use App\Models\SomForms;
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
                ->with('milestones_id', $milestones_id)
                ->with('somForms', $somForms);
    }

    /**
     * Show the form for creating a new SomForms.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $somForm = new SomForms(); 
        $milestones_id = $request->get('milestones_id');
        $somForm->active = 1;
        $somForm->order_form = 1;
        $somForm->som_milestones_forms_types_id = 1;
        $somForm->som_phases_milestones_id = $milestones_id;
        return view('som_forms.create')
                ->with('milestones_id', $milestones_id)
                ->with('somForms', $somForm);
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
        $milestones_id = $somForms->som_phases_milestones_id;
        return redirect(route('somForms.index',['milestones_id'=> $milestones_id]));
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
        $milestones_id = $somForms->som_phases_milestones_id;
        return view('som_forms.show')
                ->with('milestones_id', $milestones_id)
                ->with('somForms', $somForms);
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
        $milestones_id =  $somForms->som_phases_milestones_id;
        return view('som_forms.edit')
                ->with('milestones_id', $milestones_id )
                ->with('somForms', $somForms);
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
        $milestones_id =  $somForms->som_phases_milestones_id;
        Flash::success('Som Forms updated successfully.');

        return redirect(route('somForms.index', ['milestones_id'=>$milestones_id ]));
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
        $milestones_id =  $somForms->som_phases_milestones_id;
        $this->somFormsRepository->delete($id);

        Flash::success('Som Forms deleted successfully.');
        
        return redirect(route('somForms.index', ['milestones_id'=>$milestones_id]));
    }
}
