<?php

namespace App\Repository;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Unit;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;
use function Symfony\Component\String\b;

abstract class BaseRepo
{

    protected $button;
    protected $selectData;
    protected $data;
    protected $class;

    /** @var Unit $model */
    protected function datatabe($model)
    {
//        $data = ;
        return DataTables::of($model)
                         ->removeColumn('id')
                         ->addColumn(
                             'action',
                             function ($data) {
                                 $this->data = $data;
                                 return $this->dataButton();
                             }
                         )
                         ->make(true);
    }

    public function dataButton()
    {

        if ($this->button) {
            foreach ($this->button as $button) {
                $buttonInject[] = $this::$button();
            }
        }
        $dd = '<div class="flex justify-center gap-2">';
        foreach ($buttonInject as $b){
            $dd .= $b;
        }
        $dd .= '</div>';
        return $dd;
    }

    public function edit(){
        $id       = $this->data->id;
        $dataAttr = '';
        $clas = $this->class;
        foreach ($this->selectData as $key => $d) {
            $dataAttr .= ' data-'.$d.'="'.$this->data[$d].'"';
        }
        return '<a role="button" id="editData" class="text-xs font-bold bg-secondary rounded-full text-white px-3 py-2 btn-editsatuan" data-id="'.$id.'" '.$dataAttr.'>Edit</a>';
    }

    public function delete(){
        $clas = $this->class;

        $id       = $this->data->id;
        return '<a role="button" class="text-xs font-bold bg-red-500 rounded-full text-white px-3 py-2 btn-editsatuan"  id="deleteData" data-id="'.$id.'">Hapus</a>';
    }

    public function validation(){
        return true;
    }


    public function fieldData(){
        return request()->all();
    }


    /** @var Unit $model */
    public function patchData($model){
        $this->validation();
        if (request('id')){
            $data = $model::find(request('id'));
            $data->update($this->fieldData());
        }else{
            $data = new $model();
            $data->create($this->fieldData());
        }
        return 'sucess';
    }

    public function deleteFile()
    {
        $id   = $this->request->get('id');
        $file = File::find($id);
        if (file_exists(public_path().$file->url)) {
            unlink(public_path().$file->url);
        }
        File::destroy($id);

        return response()->json('success');
    }

}
