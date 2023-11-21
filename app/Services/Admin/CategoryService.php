<?php

namespace App\Services\Admin;

use App\Enums\StatusEnum;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'categories' => Category::orderBy('created_at', 'desc')->get(),
        ];

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data)
    {
        Category::create([
            ...$data,
            'cat_code' => 'RT'.strtoupper(substr($data['name_en'], 0, 3)),
            'created_by' => auth()->id(),
            'status' => StatusEnum::Active->value,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return [
            'category' => $category,
            'categories' => Category::all(),
        ];
    }

    public function update(array $data, $category)
    {
        $category->update([
            ...$data,
            'cat_code' => 'RT'.strtoupper(substr($data['name_en'], 0, 3)),
            'updated_by' => auth()->id(),
        ]);
        Session::flash('status', 'Category Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('categories.index')]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index')->with('status', "Categories's Info Successfully Deleted.");
    }

    public function changeStatus(Category $category)
    {
        $category->update([
            'status' => $category->status == 1 ? 0 : 1,
        ]);
        Session::flash('status', 'Category Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('categories.index')]);
    }
}
