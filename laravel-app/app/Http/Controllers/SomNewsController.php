<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomNewsRequest;
use App\Http\Requests\UpdateSomNewsRequest;
use App\Repositories\SomNewsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomNewsController extends AppBaseController
{
    /** @var  SomNewsRepository */
    private $somNewsRepository;

    public function __construct(SomNewsRepository $somNewsRepo)
    {
        $this->somNewsRepository = $somNewsRepo;
    }

    /**
     * Display a listing of the SomNews.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somNews = $this->somNewsRepository->all();

        return view('som_news.index')
            ->with('somNews', $somNews);
    }

    /**
     * Show the form for creating a new SomNews.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_news.create');
    }

    /**
     * Store a newly created SomNews in storage.
     *
     * @param CreateSomNewsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomNewsRequest $request)
    {
        $input = $request->all();

        $somNews = $this->somNewsRepository->create($input);

        Flash::success('Som News saved successfully.');

        return redirect(route('somNews.index'));
    }

    /**
     * Display the specified SomNews.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somNews = $this->somNewsRepository->find($id);

        if (empty($somNews)) {
            Flash::error('Som News not found');

            return redirect(route('somNews.index'));
        }

        return view('som_news.show')->with('somNews', $somNews);
    }

    /**
     * Show the form for editing the specified SomNews.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somNews = $this->somNewsRepository->find($id);

        if (empty($somNews)) {
            Flash::error('Som News not found');

            return redirect(route('somNews.index'));
        }

        return view('som_news.edit')->with('somNews', $somNews);
    }

    /**
     * Update the specified SomNews in storage.
     *
     * @param int $id
     * @param UpdateSomNewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomNewsRequest $request)
    {
        $somNews = $this->somNewsRepository->find($id);

        if (empty($somNews)) {
            Flash::error('Som News not found');

            return redirect(route('somNews.index'));
        }

        $somNews = $this->somNewsRepository->update($request->all(), $id);

        Flash::success('Som News updated successfully.');

        return redirect(route('somNews.index'));
    }

    /**
     * Remove the specified SomNews from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somNews = $this->somNewsRepository->find($id);

        if (empty($somNews)) {
            Flash::error('Som News not found');

            return redirect(route('somNews.index'));
        }

        $this->somNewsRepository->delete($id);

        Flash::success('Som News deleted successfully.');

        return redirect(route('somNews.index'));
    }
}
