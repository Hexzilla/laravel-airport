<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsEmailTemplatesRequest;
use App\Http\Requests\UpdateCmsEmailTemplatesRequest;
use App\Repositories\CmsEmailTemplatesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsEmailTemplatesController extends AppBaseController
{
    /** @var  CmsEmailTemplatesRepository */
    private $cmsEmailTemplatesRepository;

    public function __construct(CmsEmailTemplatesRepository $cmsEmailTemplatesRepo)
    {
        $this->cmsEmailTemplatesRepository = $cmsEmailTemplatesRepo;
    }

    /**
     * Display a listing of the CmsEmailTemplates.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsEmailTemplates = $this->cmsEmailTemplatesRepository->all();

        return view('cms_email_templates.index')
            ->with('cmsEmailTemplates', $cmsEmailTemplates);
    }

    /**
     * Show the form for creating a new CmsEmailTemplates.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_email_templates.create');
    }

    /**
     * Store a newly created CmsEmailTemplates in storage.
     *
     * @param CreateCmsEmailTemplatesRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsEmailTemplatesRequest $request)
    {
        $input = $request->all();

        $cmsEmailTemplates = $this->cmsEmailTemplatesRepository->create($input);

        Flash::success('Cms Email Templates saved successfully.');

        return redirect(route('cmsEmailTemplates.index'));
    }

    /**
     * Display the specified CmsEmailTemplates.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsEmailTemplates = $this->cmsEmailTemplatesRepository->find($id);

        if (empty($cmsEmailTemplates)) {
            Flash::error('Cms Email Templates not found');

            return redirect(route('cmsEmailTemplates.index'));
        }

        return view('cms_email_templates.show')->with('cmsEmailTemplates', $cmsEmailTemplates);
    }

    /**
     * Show the form for editing the specified CmsEmailTemplates.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsEmailTemplates = $this->cmsEmailTemplatesRepository->find($id);

        if (empty($cmsEmailTemplates)) {
            Flash::error('Cms Email Templates not found');

            return redirect(route('cmsEmailTemplates.index'));
        }

        return view('cms_email_templates.edit')->with('cmsEmailTemplates', $cmsEmailTemplates);
    }

    /**
     * Update the specified CmsEmailTemplates in storage.
     *
     * @param int $id
     * @param UpdateCmsEmailTemplatesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsEmailTemplatesRequest $request)
    {
        $cmsEmailTemplates = $this->cmsEmailTemplatesRepository->find($id);

        if (empty($cmsEmailTemplates)) {
            Flash::error('Cms Email Templates not found');

            return redirect(route('cmsEmailTemplates.index'));
        }

        $cmsEmailTemplates = $this->cmsEmailTemplatesRepository->update($request->all(), $id);

        Flash::success('Cms Email Templates updated successfully.');

        return redirect(route('cmsEmailTemplates.index'));
    }

    /**
     * Remove the specified CmsEmailTemplates from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsEmailTemplates = $this->cmsEmailTemplatesRepository->find($id);

        if (empty($cmsEmailTemplates)) {
            Flash::error('Cms Email Templates not found');

            return redirect(route('cmsEmailTemplates.index'));
        }

        $this->cmsEmailTemplatesRepository->delete($id);

        Flash::success('Cms Email Templates deleted successfully.');

        return redirect(route('cmsEmailTemplates.index'));
    }
}
