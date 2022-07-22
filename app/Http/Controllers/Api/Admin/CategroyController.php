<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategroyController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var Category
     */
    protected $categoryModel;


    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = $this->categoryModel->get();

        return $this->apiResponse('successfully', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $category = $this->categoryModel->create([
            'name' => $request->post('name'),
        ]);

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            $category->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        return $this->apiResponse('successfully', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $category = $this->categoryModel->find($request->post('category_id'));

        $category->update([
            'name' => $request->post('name'),
        ]);

        return $this->apiResponse('successfully', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $validator = validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $this->categoryModel->find($request->post('category_id'))->delete();

        return $this->apiResponse('successfully');
    }
}
