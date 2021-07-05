<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsEmailQueuesRequest;
use App\Http\Requests\UpdateCmsEmailQueuesRequest;
use App\Repositories\CmsEmailQueuesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsEmailQueuesController extends AppBaseController
{
    /** @var  CmsEmailQueuesRepository */
    private $cmsEmailQueuesRepository;

    public function __construct(CmsEmailQueuesRepository $cmsEmailQueuesRepo)
    {
        $this->cmsEmailQueuesRepository = $cmsEmailQueuesRepo;
    }

    /**
     * Display a listing of the CmsEmailQueues.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsEmailQueues = $this->cmsEmailQueuesRepository->all();

        return view('cms_email_queues.index')
            ->with('cmsEmailQueues', $cmsEmailQueues);
    }

    /**
     * Show the form for creating a new CmsEmailQueues.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_email_queues.create');
    }

    /**
     * Store a newly created CmsEmailQueues in storage.
     *
     * @param CreateCmsEmailQueuesRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsEmailQueuesRequest $request)
    {
        $input = $request->all();

        $cmsEmailQueues = $this->cmsEmailQueuesRepository->create($input);

        Flash::success('Cms Email Queues saved successfully.');

        return redirect(route('cmsEmailQueues.index'));
    }

    /**
     * Display the specified CmsEmailQueues.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsEmailQueues = $this->cmsEmailQueuesRepository->find($id);

        if (empty($cmsEmailQueues)) {
            Flash::error('Cms Email Queues not found');

            return redirect(route('cmsEmailQueues.index'));
        }

        return view('cms_email_queues.show')->with('cmsEmailQueues', $cmsEmailQueues);
    }

    /**
     * Show the form for editing the specified CmsEmailQueues.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsEmailQueues = $this->cmsEmailQueuesRepository->find($id);

        if (empty($cmsEmailQueues)) {
            Flash::error('Cms Email Queues not found');

            return redirect(route('cmsEmailQueues.index'));
        }

        return view('cms_email_queues.edit')->with('cmsEmailQueues', $cmsEmailQueues);
    }

    /**
     * Update the specified CmsEmailQueues in storage.
     *
     * @param int $id
     * @param UpdateCmsEmailQueuesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsEmailQueuesRequest $request)
    {
        $cmsEmailQueues = $this->cmsEmailQueuesRepository->find($id);

        if (empty($cmsEmailQueues)) {
            Flash::error('Cms Email Queues not found');

            return redirect(route('cmsEmailQueues.index'));
        }

        $cmsEmailQueues = $this->cmsEmailQueuesRepository->update($request->all(), $id);

        Flash::success('Cms Email Queues updated successfully.');

        return redirect(route('cmsEmailQueues.index'));
    }

    /**
     * Remove the specified CmsEmailQueues from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsEmailQueues = $this->cmsEmailQueuesRepository->find($id);

        if (empty($cmsEmailQueues)) {
            Flash::error('Cms Email Queues not found');

            return redirect(route('cmsEmailQueues.index'));
        }

        $this->cmsEmailQueuesRepository->delete($id);

        Flash::success('Cms Email Queues deleted successfully.');

        return redirect(route('cmsEmailQueues.index'));
    }
}
