<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $list = $this->categoryRepository->getWithPagination(10);
        $data = new CategoryCollection($list);
        return $this->responseSuccess($data, Response::HTTP_OK);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        if ($category) {
            return $this->responseSuccess(new CategoryResource($category), Response::HTTP_OK);
        }
        return $this->responseError('Not found', Response::HTTP_NOT_FOUND);
    }

    public function store(Request $request)
    {
        $category = $this->categoryRepository->create($request->all());
        return $this->responseSuccess($category, Response::HTTP_OK);
    }

    public function update(Request $request, $category)
    {
        $category = $this->categoryRepository->update($category, $request->all());
        return $this->responseSuccess($category, Response::HTTP_OK);
    }

    public function destroy($category)
    {
        $this->categoryRepository->delete($category);
        return $this->responseSuccess([], Response::HTTP_OK);
    }
}
