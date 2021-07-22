<?php

namespace App\Http\Controllers\SmartCity;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\SmartCity\SmartCityController as SmartCityController;
use App\Models\Point;
use Validator;
use App\Models\UploadImage;

class PointController extends SmartCityController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Point $point
     * @return JsonResponse
     */
    public function index(Request $request, Point $point)
    {
        $point = Point::all()->where("point" , "=" , $request->get("pointId"));

        return $this->sendResponse($point, 'Point retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Point $point
     * @param UploadImage $imageBase64
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request, Point $point, UploadImage $imageBase64)
    {
        $fileUrl = null;

        if ($request->filled('image') && $request->image!= '') {
            $imageBase64 = $request->image;
            $fileUrl = UploadImage::save($imageBase64, 'pictures', 'jpg')->getUrl();
        }

        $response = array(
            'comment' => $request->input('comment'),
            'image' => $fileUrl,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'type' => $request->input('type'),
        );
        $point->fill($response)->save();

        return $this->sendResponse( $point,  'Point created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $point = Point::find($id);
        return $this->sendResponse($point, 'Point retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $point = Point::find( $id )
            ->update( $request
                ->only( ['comment', 'image', 'latitude', 'longitude', 'type'] ) );
        return $this->sendResponse($point, 'Point updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Point $point
     * @param $id
     * @return JsonResponse
     */
    public function destroy(Point $point, $id)
    {
        $point = Point::find($id);
        $point->delete();
        if (!$point) {
            return $this->sendError('Point not found.');
        }
        return $this->sendResponse($point, 'Point deleted successfully.');
    }

}
