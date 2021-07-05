<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectUsersRequest;
use App\Http\Requests\UpdateSomProjectUsersRequest;
use App\Repositories\SomProjectUsersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectUsersController extends AppBaseController
{
    /** @var  SomProjectUsersRepository */
    private $somProjectUsersRepository;

    public function __construct(SomProjectUsersRepository $somProjectUsersRepo)
    {
        $this->somProjectUsersRepository = $somProjectUsersRepo;
    }

    /**
     * Display a listing of the SomProjectUsers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectUsers = $this->somProjectUsersRepository->all();

        return view('som_project_users.index')
            ->with('somProjectUsers', $somProjectUsers);
    }

    /**
     * Show the form for creating a new SomProjectUsers.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_project_users.create');
    }

    /**
     * Store a newly created SomProjectUsers in storage.
     *
     * @param CreateSomProjectUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectUsersRequest $request)
    {
        $input = $request->all();

        $somProjectUsers = $this->somProjectUsersRepository->create($input);

        Flash::success('Som Project Users saved successfully.');

        return redirect(route('somProjectUsers.index'));
    }

    /**
     * Display the specified SomProjectUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        return view('som_project_users.show')->with('somProjectUsers', $somProjectUsers);
    }

    /**
     * Show the form for editing the specified SomProjectUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        return view('som_project_users.edit')->with('somProjectUsers', $somProjectUsers);
    }

    /**
     * Update the specified SomProjectUsers in storage.
     *
     * @param int $id
     * @param UpdateSomProjectUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectUsersRequest $request)
    {
        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        $somProjectUsers = $this->somProjectUsersRepository->update($request->all(), $id);

        Flash::success('Som Project Users updated successfully.');

        return redirect(route('somProjectUsers.index'));
    }

    /**
     * Remove the specified SomProjectUsers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        $this->somProjectUsersRepository->delete($id);

        Flash::success('Som Project Users deleted successfully.');

        return redirect(route('somProjectUsers.index'));
    }
}
