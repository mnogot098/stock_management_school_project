<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display all employees
     */
    function index(){
        $employees = User::where('role_id', 2)->paginate(1); // 2 = employee
        return view('employees.index', ['employees' => $employees]);
    }
    /**
     *  Displaying a form for adding a new employee
     */  
    function add(){
        return view('employees.add');
    }

    /**
     * Store the newly added employee
     */
    function store(Request $request){
        //Validating the request
        $employee = new User; //create new user

        $employee->first_name =  $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone_number = $request->phone_number;
        $employee->role_id = $request->role_id;
        $employee->password = Hash::make($request->password);

        $employee->save();
        
        return back()->with('success', 'Employee added successfully!');
    }

    /**
     * Displaying the form for updating employee info
    */
    function edit($id){
        //Retrieve employee info from Database
        $employee = User::find($id);

        return view('employees.edit', ['employee' => $employee]);
    }

    /**
     * Updating employee info
    */
    function update(Request $request, $id){
        //validation the request
        
        // Retrieving the product
        $employee = User::find($id);
        //Updating the fields
        $employee->first_name =  $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone_number = $request->phone_number;
        $employee->role_id = $request->role_id;

        $employee->save();
        //If updated successully redirect back with success message
        return back()->with('success', 'Employee information updated successfully!');
    }

    /**
     * Deleting employee
    */
    function delete($id){
        //Retrieving the employee from database and deleting it
        User::destroy($id);
        return back()->with('succees','Employee deleted successfully!');
    }
}
