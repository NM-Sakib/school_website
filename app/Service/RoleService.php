<?php
namespace App\Service;


use DataTables;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Auth;

class RoleService
{
    protected $roleRepository;

    // Constructor to bind model to repo
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function all(){
        return  $this->roleRepository->all();
    }
    public function allAssociate(array $relation=[]){
        return  $this->roleRepository->all($relation);
    }
    public function getAllData(){
        $data = $this->roleRepository->all();
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<div class="btn-group">';
                if(Auth::user()->can('role_edit')){
                    $html .= '<a class="btn btn-light btn-sm mr-2" href="'.route('administrative.role.edit',$row->id).'" ><i class="ri-pencil-fill align-middle"></i></a>&nbsp;&nbsp;';
                }
                if(Auth::user()->can('role_delete')){
                   $html .= '<a  class="btn btn-danger  btn-sm" href="#" onclick="deleteData('.$row->id.');">
                        <i class="ri-delete-bin-2-fill align-middle"></i>
                    </a>';
                }
                $html .= '</div>';
                return $html;
            })
            ->addColumn('permission', function($data){
                $html = '';
                foreach($data->permissions()->pluck('name') as $permission){
                    $html.= '<span class="badge bg-primary mb-1">'.ucfirst(str_replace("_"," ",$permission)).'</span> ';
                }
                return $html;
            })
            ->rawColumns(['action','permission','delete'])
            ->blacklist(['created_at', 'updated_at','action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function findbyId($id){
        return $this->roleRepository->show($id);
    }
    public function store($request){
        return $this->roleRepository->create($request->all());
    }
    public function update($id,$request){
        return $this->roleRepository->update($request->all(),$id);
    }
    public function findAssociate($id,array $relation)
    {
        return $this->roleRepository->findAssociate($id,$relation);
    }
    public function allAssociateFilter(array $relation=[],$filter = [],$condition='hard',$result = 'multiple'){
        return $this->roleRepository->allAssociateFilter($relation,$filter,$condition,$result);
    }
    public function allAssociateFilterPagignate(array $relation=[],$filter = [],$page = 1,$condition='hard'){
        return $this->roleRepository->allAssociateFilterPagignate($relation,$filter,$page,$condition);
    }
    public function destroy($id)
    {
        return $this->roleRepository->delete($id);
    }
}
