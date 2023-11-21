<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.index', $this->categoryService->index());
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
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->store($request->validated());

        return to_route('categories.index')->with('status', 'New Category Successfully Created.');
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
        return view('category.edit', $this->categoryService->edit($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($request->validated(), $category);
        Session::flash('status', 'Category Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('categories.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index')->with('status', "Categories's Info Successfully Deleted.");
    }

    public function changeStatus(Category $category)
    {
        $category->update([
            'status' => $category->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active->value,
        ]);
        Session::flash('status', 'Category Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('categories.index')]);
    }
}
