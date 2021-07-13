<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormApprovalsRequest;
use App\Http\Requests\UpdateSomFormApprovalsRequest;
use App\Repositories\SomFormApprovalsRepository;
use App\Repositories\SomFormsRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\SomFormApprovals;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomFormApprovalsController extends AppBaseController
{
    /** @var  SomFormApprovalsRepository */
    private $somFormApprovalsRepository;
    private $somFormsRepository;

    public function __construct(
    			SomFormApprovalsRepository $somFormApprovalsRepo, 
    			SomFormsRepository $somFromsRepo)
    {
        $this->somFormApprovalsRepository = $somFormApprovalsRepo;
        $this->somFormsRepository = $somFromsRepo;
    }

    /**
     * Display a listing of the SomFormApprovals.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somforms_id = $request->get('somforms_id');
        $somFormApprovals = $this->somFormApprovalsRepository->all(['som_forms_id'=>$somforms_id]);

        return view('som_form_approvals.index')
            ->with('somforms_id', $somforms_id)
            ->with('somFormApprovals', $somFormApprovals);
    }

    /**
     * Show the form for creating a new SomFormApprovals.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $somforms_id = $request->get('somforms_id');
        $somFormApprovals = new SomFormApprovals();
        $somFormApprovals->som_forms_id = $somforms_id;
        $somFormApprovals->order = 1;
        $somFormApprovals->som_status_id = 0;
     
        $somForms= $this->somFormsRepository->all([], null, null, ['id', 'name'])->toArray();
        $somFormsIds[] =  '**Please Select a formId';
        foreach($somForms as $rows)
        {
            $somFormsIds[$rows['id']] = $rows['name']."(".$rows['id'].")";
        }

        return view('som_form_approvals.create')
                ->with('somforms_id', $somforms_id)
                ->with('somFormsIds', $somFormsIds )
                ->with('somFormApprovals', $somFormApprovals );
    }

    /**
     * Store a newly created SomFormApprovals in storage.
     *
     * @param CreateSomFormApprovalsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomFormApprovalsRequest $request)
    {
        $input = $request->all();

        $somFormApprovals = $this->somFormApprovalsRepository->create($input);

        Flash::success('Som Form Approvals saved successfully.');
        $somforms_id = $somFormApprovals->som_forms_id;
        return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
    }

    /**
     * Display the specified SomFormApprovals.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        $somforms_id = $somFormApprovals->som_forms_id;
        return view('som_form_approvals.show')
                ->with('somforms_id', $somforms_id)
		        ->with('somFormApprovals', $somFormApprovals);
    }

    /**
     * Show the form for editing the specified SomFormApprovals.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        $somforms_id = $somFormApprovals->som_forms_id;

        $somForms= $this->somFormsRepository->all([], null, null, ['id', 'name']);
        
        $formsIds[] =  '**Please Select a formId';
        foreach($somForms->toArray() as $rows)
        {
            $formsIds[$rows['id']] = $rows['name']."(".$rows['id'].")";
        }



        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        return view('som_form_approvals.edit')
            ->with('somFormApprovals', $somFormApprovals)
            ->with('somFormsIds', $formsIds)
            ->with('somforms_id', $somforms_id);
    }

    /**
     * Update the specified SomFormApprovals in storage.
     *
     * @param int $id
     * @param UpdateSomFormApprovalsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomFormApprovalsRequest $request)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        $somFormApprovals = $this->somFormApprovalsRepository->update($request->all(), $id);

        Flash::success('Som Form Approvals updated successfully.');
        $somforms_id = $somFormApprovals->som_forms_id;
        return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
    }

    /**
     * Remove the specified SomFormApprovals from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }
        $somforms_id = $somFormApprovals->som_forms_id;

        $this->somFormApprovalsRepository->delete($id);

        Flash::success('Som Form Approvals deleted successfully.');

        return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
    }
}
