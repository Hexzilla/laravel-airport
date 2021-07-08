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

        Flash::success('News saved successfully.');

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
            Flash::error('News not found');

            return redirect(route('somNews.index'));
        }

        return view('som_news.show')->with('somNews', $somNews);
    }

    /**
     * Display a listing of the SomNews.
     * POST /news
     *
     * @param Request $request
     * @return Response
     */
    public function news(Request $request)
    {
        $date_from = $request->input('date_from');
        $date_until = $request->input('date_until');

        if ($date_from == null || $date_until == null) {
            return response()->json([
                'api_status' => 'KO',
                'api_message' => 'Missing parameters'
            ], 401);
        }

        $somNews = $this->somNewsRepository->news($date_from, $date_until);

        return response()->json([
            'api_status' => 'OK',
            'api_message' => '',
            'data' => $somNews->toArray()
        ]);
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

        Flash::success('News updated successfully.');

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
            Flash::error('News not found');

            return redirect(route('somNews.index'));
        }

        $this->somNewsRepository->delete($id);

        Flash::success('News deleted successfully.');

        return redirect(route('somNews.index'));
    }
}
