<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Employee;
use App\Models\User;

class EmployeeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    return Employee::all();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $fields = $request->validate([
      'empname' => 'required|string',
      'email' => 'required|string|unique:tbl_employees,email',
      'password' => 'required|string|'
    ]);

    $employee = new Employee();
    $employee->empcode = 'EM-'.Str::random(5);
    $employee->empname = $fields['empname'];
    $employee->address = $request->address;
    $employee->phone = $request->phone;
    $employee->email = $fields['email'];
    $employee->image = $request->fileName;
    $employee->save();

    if(!$employee) 
    {
      return response()->json(['status' => false, 'message' => 'Save Failed!']);
    }

    $user = User::create([
      'emp_id' => $employee->id,
      'name' => $fields['empname'],
      'email' => $fields['email'],
      'password' => bcrypt($fields['password']),
      'is_employee' => 1,
    ]);

    if($user)
    {
      $user->createToken($user->name.'Token')->plainTextToken;
    }


    return response()->json(['status' => true, 'message' => 'Save Success!']);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function show(Employee $employee)
  {
    return $employee;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function edit(Employee $employee)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Employee $employee)
  {
    $fields = $request->validate([
      'empname' => 'required|string',
      'email' => 'required|string|',
      'password' => 'required|string|'
    ]);

    $employee->empcode = 'EM-'.Str::random(5);
    $employee->empname = $fields['empname'];
    $employee->address = $request->address;
    $employee->phone = $request->phone;
    $employee->email = $fields['email'];
    $employee->image = $request->fileName ? $request->fileName : '';
    $employee->save();

    if(!$employee) 
    {
      return response()->json(['status' => false, 'message' => 'Update Failed!']);
    }

    $user = User::find($employee->id);
    $user->name = $fields['empname'];
    $user->email = $fields['email'];
    $user->password = bcrypt($fields['password']);
    $user->save();

    if(!$user) 
    {
      return response()->json(['status' => false, 'message' => 'Update Failed!']);
    }

    return response()->json(['status' => true, 'message' => 'Update Success!']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function destroy(Employee $employee)
  {
    $delete = $employee->delete();

    if(!$delete) 
    {
      return response()->json(['status' => false, 'message' => 'Delete Failed!']);
    }
    return response()->json(['status' => true, 'message' => 'Delete Success!']);
  }
}
