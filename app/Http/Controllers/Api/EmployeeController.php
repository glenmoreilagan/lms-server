<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Employee;

class EmployeeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
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
    $employee = new Employee();
    $employee->empcode = 'EM-'.Str::random(5);
    $employee->address = $request->address;
    $employee->empname = $request->empname;
    $employee->image = $request->fileName;
    $employee->phone = $request->phone;
    $employee->save();

    return $employee;
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
    $employee->empcode = 'EM-'.Str::random(5);
    $employee->address = $request->address;
    $employee->empname = $request->empname;
    $employee->image = $request->fileName ? $request->fileName : '';
    $employee->phone = $request->phone;
    $employee->save();

    return $employee;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function destroy(Employee $employee)
  {
    return $employee->delete();
  }
}
