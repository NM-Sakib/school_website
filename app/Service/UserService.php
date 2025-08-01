<?php

namespace App\Service;


use DataTables;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userRepository;

    // Constructor to bind model to repo
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return  $this->userRepository->all();
    }
    public function allAssociate(array $relation = [])
    {
        return  $this->userRepository->all($relation);
    }
    public function getAllData()
    {
        $data = $this->userRepository->all();
        $data = $data->where('email', '!=', 'platform.singularity@gmail.com');
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                        $html = '<div class="btn-group">';
                        if(Auth::user()->can('role_delete')){
                        $html .= '<a class="btn btn-light btn-sm mr-2" href="' . route('administrative.user.edit', $row->id) . '" >
                                    <i class="ri-pencil-fill align-middle"></i>
                                    </a>&nbsp;&nbsp;';
                        }
                        if(Auth::user()->can('role_delete')){
                            $html .= '<a class="btn btn-danger  btn-sm" href="#" onclick="deleteData('.$row->id.');">
                                        <i class="ri-delete-bin-2-fill align-middle"></i>
                                    </a>';
                        }
                        $html .= '</div>';
                        return $html;
            })
            ->addColumn('role', function ($data) {
                $html = '<span class="badge bg-primary">' . optional($data->roles->first())->name . '</span> ';
                return $html;
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 1) {
                    $html =  '<span class="badge bg-success">Active</span>';
                } else{
                    $html =  '<span class="badge bg-warning">Inactive</span>';
                }
                return $html;
            })
            ->rawColumns(['action', 'role', 'status'])
            ->blacklist(['created_at', 'updated_at', 'action'])
            ->addIndexColumn()
            ->toJson();
    }

    public function findbyId($id)
    {
        return $this->userRepository->show($id);
    }
    public function store($request)
    {
        return $this->userRepository->create($request->all());
    }
    public function update($id, $request)
    {
        return $this->userRepository->update($request->all(), $id);
    }
    public function findAssociate($id)
    {
        return $this->userRepository->findAssociate($id);
    }
    public function getUserByRoleFilter()
    {
        $relationFilter = ['roles' => [
            'filterColumn' => 'name',
            'filterCondition' => '=',
            'filterConditionValue' => 'Manager',
        ]];
        return $this->userRepository->allAssociateRelationFilter($relationFilter);
    }
    public function destroy($id)
    {
        return $this->userRepository->delete($id);
    }
}
