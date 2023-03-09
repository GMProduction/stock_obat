<?php

namespace App\Repository;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Unit;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;
use function Symfony\Component\String\b;

abstract class BaseRepo
{

    protected $button;
    protected $selectData = [];
    protected $data;
    protected $class;
    protected $addColumn = [];

    /** @var Unit $model */
    protected function datatabe($model)
    {
        $tabel = DataTables::of($model)
                           ->removeColumn('id');

        if ($this->button) {
            $tabel = $tabel->addColumn(
                'action',
                function ($data) {
                    $this->data = $data;

                    return $this->dataButton();
                }
            );
        }

        foreach ($this->addColumn as $d) {
            $tabel = $tabel->addColumn(
                $d['name'],
                function ($data) use ($d) {
                    $string = isset($d['value']) ? explode('.', $d['value']) : [];
                    $dd     = $data;
                    foreach ($string as $s) {
                        if ($dd) {
                            $dd = $dd->{$s};
                        } else {
                            $dd = null;
                        }
                    }
                    if ($d['string_value']) {
                        $dd = $d['string_value'];
                    }

                    return $dd;
                }
            );
        }
        $tabel = $tabel->make(true);
        return $tabel;
    }

    public function dataButton()
    {
        $buttonInject = [];
        if ($this->button) {
            foreach ($this->button as $button) {
                $buttonInject[] = $this::$button();
            }
        }
        $dd = '<div class="flex justify-center gap-2">';
        foreach ($buttonInject as $b) {
            $dd .= $b;
        }
        $dd .= '</div>';

        return $dd;
    }

    public function edit()
    {
        $id       = $this->data->id;
        $dataAttr = '';
        $clas     = $this->class;
        foreach ($this->selectData as $key => $d) {
            $dataAttr .= ' data-'.$d.'="'.$this->data[$d].'"';
        }

        return '<a role="button" id="editData" class="text-xs font-bold bg-secondary rounded-full text-white px-3 py-2 btn-editsatuan" data-id="'.$id.'" '.$dataAttr.'>Edit</a>';
    }

    public function delete()
    {
        $clas = $this->class;

        $id = $this->data->id;
        $dataAttr = '';
        foreach ($this->selectData as $key => $d) {
            $dataAttr .= ' data-'.$d.'="'.$this->data[$d].'"';
        }
        if ($clas){
            $dataAttr .= ' data-class='.$clas;
        }

        return '<a role="button" class="text-xs font-bold bg-red-500 rounded-full text-white px-3 py-2 btn-editsatuan"  id="deleteData" data-id="'.$id.'"  '.$dataAttr.'>Hapus</a>';
    }

    public function detail()
    {
        $id = $this->data->id;

        return '<a href="" id="detailData" data-id="'.$id.'"
                                    class="text-xs bg-secondary rounded-full text-white px-3 py-2">Detail</a></td>';
    }

    public function validation()
    {
        return true;
    }

    public function fieldData()
    {
        return request()->all();
    }

    /** @var Unit $model */
    public function patchData($model)
    {
        $this->validation();
        if (request('id')) {
            $data = $model::find(request('id'));
            $data->update($this->fieldData());
        } else {
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

    public function destroy($class, $id)
    {
        $data = $class::find($id);
        $data->delete();

        return 'success';
    }
}
