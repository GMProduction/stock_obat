<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Category;
use App\Repository\CategoryRepository;

class CategoryController extends CustomController
{
    private $repo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->repo = $categoryRepository;
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


    public function getAll(){
        return $this->repo->getAll();
    }

}
