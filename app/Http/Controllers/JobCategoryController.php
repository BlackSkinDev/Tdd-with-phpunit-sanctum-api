<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobCategoryResource;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class JobCategoryController extends Controller
{
    public function store(Request $request){

        $rules = array(
            'title' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()],Response::HTTP_BAD_REQUEST);
        }


        $jobCategory = new JobCategory();
        $jobCategory->title = $request->title;
        $jobCategory->user_id = auth()->id();
        $jobCategory->save();

        return response()->json([
            'data'=>[
                'title'=>$jobCategory->title,
                'id'=>$jobCategory->id
            ],
            'message'=>'Job category created',
            'status'=>true
        ],Response::HTTP_CREATED);
    }

    public function index(){
        return response()->json([
            'data'=>JobCategoryResource::collection(JobCategory::all())
        ],Response::HTTP_OK);
    }


}
