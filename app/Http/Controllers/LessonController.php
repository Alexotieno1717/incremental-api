<?php

namespace App\Http\Controllers;

use App\Acme\transformers\LessonTransformer;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class LessonController extends ApiController
{
    /**
     * @var LessonTransformer
     */
    protected LessonTransformer $lessonTransformer;

    function __construct(LessonTransformer $lessonTransformer){
        $this->lessonTransformer = $lessonTransformer;

//        $this->beforeFilter('auth.basic');
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $lessons = Lesson::all();
        return $this->respond([
            'data' => $this->lessonTransformer->transformCollection($lessons->all())
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (! $lesson){
            return $this->respondNotFound('Lesson does not exist');
        }

        return $this->respond([
            'data' => $this->lessonTransformer->transform($lesson)
        ]);
    }

    public function store()
    {
        dd('store');
    }
}
