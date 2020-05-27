<?php

namespace App\Http\Controllers\API;

use App\File;
use App\Http\Resources\MovieCollection;
use App\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Movie as MovieResource;

class MovieController extends BaseController
{
    private const PER_PAGE = 50;
    /**
     * @return MovieCollection
     */
    public function index(): MovieCollection
    {
        return (new MovieCollection(Movie::paginate(self::PER_PAGE)));
    }

    /**
     * @param Request $request
     * @param Movie $movie
     * @param File $file
     * @param Validator $validator
     * @param Auth $auth
     * @param Arr $arr
     * @return JsonResponse
     */
    public function store(Request $request, Movie $movie, File $file, Validator $validator, Auth $auth, Arr $arr): JsonResponse
    {
        $input = $request->all();
        $validator = $validator::make($input, $movie::$rules);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input['user_id'] = $auth::id();
        $movie = $movie::create($arr::except($input, 'label'));

        if ($request->hasFile('label')) {
            $file->insertGetName($request->file('label'), $movie->id);
        }
        return $this->sendResponse((new MovieResource($movie)), 'Successfully created movies!');
    }

    /**
     * @param Request $request
     * @param int $id
     * @param Movie $movie
     * @param Auth $auth
     * @param Validator $validator
     * @param Arr $arr
     * @return JsonResponse
     */
    public function update(Request $request, int $id, Movie $movie, Auth $auth, Validator $validator, Arr $arr): JsonResponse
    {
        $authId = $auth::id();

        if (!$movie::where(['id' => $id, 'user_id' => $authId])->exists()) {
            return $this->sendError('You do not have access to this record!');
        }

        $input = $request->all();

        $validator = $validator::make($input, $movie::$rules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['user_id'] = $authId;

        $movie::where('id', $id)->update($arr::except($input, ['label', '_method']));
        $movie = $movie::find($id);

        if ($request->hasFile('label')) {
            unlink(public_path('files/') . $movie->file->name);
            $movie->file->insertGetName($request->file('label'), $movie->id);
        }

        return $this->sendResponse((new MovieResource($movie)), 'Successfully update movie!');
    }

    /**
     * @param int $id
     * @param Movie $movie
     * @param File $file
     * @param Auth $auth
     * @return JsonResponse
     */
    public function destroy(int $id, Movie $movie, File $file, Auth $auth): JsonResponse
    {
        $authId = $auth::id();

        if (!$movie::where(['id' => $id, 'user_id' => $authId])->exists()) {
            return $this->sendError('You do not have access to this record!');
        }

        $movie::destroy($id);
        $file::where('movie_id', $id)->delete();

        return $this->sendResponse([], 'Successfully delete movie!');
    }

    /**
     * @param Request $request
     * @param Movie $movie
     * @return MovieCollection
     */
    public function find(Request $request, Movie $movie): MovieCollection
    {
        $title = $request->get('title');

        if (empty($title)) {
            return $this->sendError('Field title should be not empty', []);
        }
        return (new MovieCollection($movie::where('title', $title)->paginate(self::PER_PAGE)));
    }
}
