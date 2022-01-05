<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Model\Expertise;
use App\Repositories\ExpertiseRepositroy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExpertiseController extends BaseController
{
    protected $expertiseRepository;

    public function __construct(ExpertiseRepositroy $expertiseRepository)
    {
        $this->expertiseRepository = $expertiseRepository;
    }

    public function index()
    {
        $expertise = DB::table('expertises')->latest()->get();
        return view('admin.expertise.manage', ["expertise" => $expertise]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'expertise_name.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors(),
            ]);
        }
        $this->expertiseRepository->storeExpertise($request);
        $expertise = DB::table('expertises')->latest()->get();
        return response()->json([
            "status_code" => 200,
            "message" => "success",
            "expertise" => $expertise,
        ]);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'expertise_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $expertise = Expertise::find($id);
        $expertise->expertise_name = $request->expertise_name;
        $expertise->save();
    }

}
