<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{

    public function index(){
        $data = Employee::all();
        //return $data;
        return response()->json($data);
    }


    public function store(Request $request){

         $data = Employee::create([

            'name' => $request->name,
             'address' => $request->address,
             'number' => $request->number,


         ]);
         return "success";
    }
    public function edit($id){

        $data = Employee::find($id);
        //return $data;
        return response()->json($data);
    }

    public function update(Request $request, $id){

        $data = Employee::find($id)->update($request->all());

        return response()->json($data);
    }

    public function delete($id){

        $data = Employee::find($id)->delete();

        //return reponse()->json($data);
        return true;
    }

    


}
