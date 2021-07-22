<?php


namespace App\Http\Controllers\SmartCity;


use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\SmartCity\SmartCityController as SmartCityController;

class TagController extends SmartCityController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $tag = Tag::all()->where("tag" , "=" , $request->get("tagId"));
        return $this->sendResponse($tag, 'Tags retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     * @return JsonResponse
     */
    public function store(Request $request, Tag $tag)
    {
        $tag->fill($request->all())->save();

        return $this->sendResponse($tag, 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return $this->sendResponse($tag, 'Tag retrieved successfully.');
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
        $tag = Tag::find( $id )->update( $request->only( ['title'] ) );
        return $this->sendResponse($tag, 'Tag updated successfully.');
        //return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        if ($tag == "") {
            return $this->sendError('Tag not found.');
        }
        return $this->sendResponse($tag, 'Tag deleted successfully.');
    }

}
