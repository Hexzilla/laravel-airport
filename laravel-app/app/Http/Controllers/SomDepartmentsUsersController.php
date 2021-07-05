<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomDepartmentsUsersRequest;
use App\Http\Requests\UpdateSomDepartmentsUsersRequest;
use App\Repositories\SomDepartmentsUsersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomDepartmentsUsersController extends AppBaseController
{
    /** @var  SomDepartmentsUsersRepository */
    private $somDepartmentsUsersRepository;

    public function __construct(SomDepartmentsUsersRepository $somDepartmentsUsersRepo)
    {
        $this->somDepartmentsUsersRepository = $somDepartmentsUsersRepo;
    }

    /**
     * Display a listing of the SomDepartmentsUsers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->all();

        return view('som_departments_users.index')
            ->with('somDepartmentsUsers', $somDepartmentsUsers);
    }

    /**
     * Show the form for creating a new SomDepartmentsUsers.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_departments_users.create');
    }

    /**
     * Store a newly created SomDepartmentsUsers in storage.
     *
     * @param CreateSomDepartmentsUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateSomDepartmentsUsersRequest $request)
    {
        $input = $request->all();

        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->create($input);

        Flash::success('Som Departments Users saved successfully.');

        return redirect(route('somDepartmentsUsers.index'));
    }

    /**
     * Display the specified SomDepartmentsUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->find($id);

        if (empty($somDepartmentsUsers)) {
            Flash::error('Som Departments Users not found');

            return redirect(route('somDepartmentsUsers.index'));
        }

        return view('som_departments_users.show')->with('somDepartmentsUsers', $somDepartmentsUsers);
    }

    /**
     * Show the form for editing the specified SomDepartmentsUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->find($id);

        if (empty($somDepartmentsUsers)) {
            Flash::error('Som Departments Users not found');

            return redirect(route('somDepartmentsUsers.index'));
        }

        return view('som_departments_users.edit')->with('somDepartmentsUsers', $somDepartmentsUsers);
    }

    /**
     * Update the specified SomDepartmentsUsers in storage.
     *
     * @param int $id
     * @param UpdateSomDepartmentsUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomDepartmentsUsersRequest $request)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->find($id);

        if (empty($somDepartmentsUsers)) {
            Flash::error('Som Departments Users not found');

            return redirect(route('somDepartmentsUsers.index'));
        }

        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->update($request->all(), $id);

        Flash::success('Som Departments Users updated successfully.');

        return redirect(route('somDepartmentsUsers.index'));
    }

    /**
     * Remove the specified SomDepartmentsUsers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->find($id);

        if (empty($somDepartmentsUsers)) {
            Flash::error('Som Departments Users not found');

            return redirect(route('somDepartmentsUsers.index'));
        }

        $this->somDepartmentsUsersRepository->delete($id);

        Flash::success('Som Departments Users deleted successfully.');

        return redirect(route('somDepartmentsUsers.index'));
    }
}
