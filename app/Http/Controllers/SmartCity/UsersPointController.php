<?php
namespace app\Http\Controllers\SmartCity;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\SmartCity\SmartCityController as SmartCityController;
use App\Models\Point;
use App\Models\UploadImage;

class UsersPointController extends SmartCityController
{
    public function getPoints(int $id)
    {
        /** @var User $user */
        try
        {
            $user = User::find($id)
                ->points()
                ->get();
        }
        catch (\Throwable $e)
        {
           return ['error' => ['message' => 'user undefined', 'id' => $id]];
        }

        return $this->sendResponse($user, 'User points successfully displayed.');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return array|JsonResponse
     */
    public function createPoints(Request $request, int $id)
    {
        $fileUrl = null;

        if ($request->filled('image') && $request->image!= '') {
            $imageBase64 = $request->image;
            $fileUrl = UploadImage::save($imageBase64, 'pictures', 'jpg')->getUrl();
        }

        /** @var User $user */
        try
        {
            $user = User::find($id);

            $point = new Point();
            $point->comment = $request->input('comment');
            $point->image = $request->input('image');//$fileUrl;
            $point->latitude = $request->input('latitude');
            $point->longitude = $request->input('longitude');
            $point->type = $request->input('type');
            $point->user_id = $id;

            // Сохраняем связанную модель
            $user->points()->save($point);
        }
        catch (\Throwable $e)
        {
            return ['error' => ['message' => 'user undefined', 'id' => $id]];
        }

        return $this->sendResponse($point, 'User point created successfully.');
    }

    /**
     * @param int $user_id
     * @param int $id
     * @return array|JsonResponse
     */
    public function deletePoints(int $user_id, int $id)
    {
        /** @var User $user */
        try {
            $user = User::find($user_id);
            $user->points()->find($id)->delete();
        }
        catch (\Throwable $e)
        {
            if ($user)
            {
                return ['error' => ['message' => 'the user does not have points', 'id' => $id]];
            }else{
                return ['error' => ['message' => 'user undefined', 'id' => $user_id]];
            }
            //return $this->sendResponse($e, 'Points deleted successfully.');
        }

        return $this->sendResponse($user, 'Points deleted successfully.');
    }
}
