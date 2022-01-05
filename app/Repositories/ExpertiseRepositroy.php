<?php

namespace App\Repositories;

use App\Model\Expertise;

class ExpertiseRepositroy
{
    public function storeExpertise($request)
    {

        foreach ($request->expertise_name as $key => $value) {
            $expertise = new Expertise;
            $expertise->expertise_name = $request->expertise_name[$key];
            $expertise->save();
            
        }
// DB::table('expertises')->insert([
        //     "expertise_name" => $request->expertise_name[$key],
        // ]);
    }
}
