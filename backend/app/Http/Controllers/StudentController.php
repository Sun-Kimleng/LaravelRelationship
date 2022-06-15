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

        return response()->json(['student'=>$student]);
    }

    public function searching(Request $request){
        
        $student = DB::table('students')
        ->join('departments', 'students.department_id', '=', 'departments.id')
        ->join('countries', 'students.country_id', '=', 'countries.id')
        ->select('students.id', 'students.name', 'departments.name as department'
                , 'countries.name as country','students.created_at', 'students.updated_at');

        $department= $request->input('department');
        $name=$request->input('name');
        $country=$request->input('country');
    
        if($request->filled('name') && $request->filled('department') && $request->filled('country')){
            $data = $student->where('students.name','LIKE', '%'.$name.'%')
                    ->where('departments.name','=', $department)
                    ->where('countries.name','=', $country)
                    ->get();
        }

        if($request->filled('name')){
            $data = $student->where('students.name','LIKE', '%'.$name.'%')->get();
            
        }

        if($request->filled('department')){
            $data = $student->where('departments.name','=', $department)->get();
    
        }

        if($request->filled('country')){
            $data = $student->where('countries.name','=', $country)->get();
            
        }
        
        if(!$request->filled('name') && !$request->filled('department') && !$request->filled('country')){
            $data = $student->get();
            
        }


      
        return response()->json(['data' => $data, 'name'=>$name, 'department'=>$department]);
        

    }
}
