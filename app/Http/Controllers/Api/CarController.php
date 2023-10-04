<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index(Request $request)
    {
        $list = $this->carRepository->getList($request);
        $data = new CarCollection($list);
        return $this->responseSuccess($data, Response::HTTP_OK);
    }

    public function show($id)
    {
        $category = $this->carRepository->find($id);
        if ($category) {
            return $this->responseSuccess(new CarResource($category), Response::HTTP_OK);
        }
        return $this->responseError('Not found', Response::HTTP_NOT_FOUND);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $filePath = '';
        $folder = 'images';

        if ($file = $request->file('image')) {
            $filePath = $this->uploads($file, $folder);
        }

        if ($filePath) {
            $data['image'] = $filePath;
        }

        $category = $this->carRepository->create($data);
        return $this->responseSuccess($category, Response::HTTP_OK);
    }

    public function update(Request $request, $car)
    {
        $data = $request->all();
        $filePath = '';
        $folder = 'images';

        if ($file = $request->file('image')) {
            $filePath = $this->uploads($file, $folder);
        }

        if ($filePath) {
            $data['image'] = $filePath;
        }

        $category = $this->carRepository->update($car, $data);
        return $this->responseSuccess($category, Response::HTTP_OK);
    }

    public function destroy($category)
    {
        $this->carRepository->delete($category);
        return $this->responseSuccess([], Response::HTTP_OK);
    }


    public function uploads($file, $folder){
        if($file) {
            $fileName   = time() . $file->getClientOriginalName();
            $path = $folder . '/' . $fileName;
            Storage::disk('public')->put($path, File::get($file));
            return $path;
        }
    }
}
