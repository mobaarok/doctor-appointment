<?php


Route::prefix('/{locale}')->group(function ($locale) {

});

// Route::get('welcome/{locale}', function ($locale) {
//     App::setLocale($locale);
//     return view('welcome');
//     //
// });


use Carbon\Carbon;
use Carbon\Factory;
use App\Model\VisitHour;
use Illuminate\Support\Facades\DB;
// Route::get('time', function (){
//      echo Carbon::now("Asia/Dhaka")->format('h:i a'). "<br>";
//     //   echo Carbon::parse(' 21:57:40', "Asia/Dhaka")->isoFormat('h:m A');
// });

        $hospitals = DB::table('hospitals')
            ->where([
                ["hospital_name", "like", "%{$search}%"],
                ['division', '=', $reqDivision],
            ])
            ->paginate(8);

        $doctor = DB::table('doctors_in_hospitals')
            ->join('doctors', 'doctors_in_hospitals.doctor_id', '=', 'doctors.id')
            ->join('hospitals', 'doctors_in_hospitals.hospital_id', '=', 'hospitals.id')
            ->where('hospitals.division', '=', $reqDivision)
            ->paginate(8);

$doctors = Doctor::with([
    'qualifications.degree',
    'qualifications.institute',
    'expertises.expertise',
])->whereHas('hospitals', function (Builder $query) use ($city_id, $search) {
    $query->where('upazila', '=', $city_id);
    $query->where('doctor_name', "like", "%{$search}%");
})->paginate(8);
