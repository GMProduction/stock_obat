<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Category;

class CategoryController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Category::all();
    }

    public function store()
    {
        try {
            $data_request = [
                'name' => $this->postField('name')
            ];
            Category::create($data_request);
            return redirect()->back()->with('success', 'Berhasil menambahkan data...');
        }catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Gagal menambahkan data...');
        }
    }

    public function patch($id)
    {
        try {
            $data = Category::find($id);
            $data_request = [
                'name' => $this->postField('name')
            ];
            $data->update($data_request);
            return redirect()->back()->with('success', 'Berhasil menambahkan data...');
        }catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Gagal menambahkan data...');
        }
    }

}
