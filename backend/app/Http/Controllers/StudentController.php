<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    
    public function create(Request $request){

        $student = new Student([
            'name'=> $request->input('name'),
            'country_id'=> $request->input('country')
        ]);

    
        $department = Department::find($request->input('department'));
   
        $department->students()->save($student);
        
        return response()->json(['message'=>'succesful created student']);
       
    }

    public function fetch(){
        //fetch all
        // $student = Student::with('departments')->get()->toArray();
        $student = DB::table('students')
        ->join('departments', 'students.department_id', '=', 'departments.id')
        ->join('countries', 'students.country_id', '=', 'countries.id')
        ->select('students.*', 'departments.name as depart_name', 'countries.name as count_name')
        ->get();


        // $department= Department::find(1);
        // $student = $department->students;
        foreach($student as $data){
            $result = $data;
        }

        return response()->json(['student'=>$student]);
    }
}
