<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return Department::all();
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
    $department = new Department();
    $department->deptprefix = $request->deptprefix;
    $department->deptcode = $request->deptcode;
    $department->deptname = $request->deptname;
    $department->save();

    return $department;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Department  $department
   * @return \Illuminate\Http\Response
   */
  public function show(Department $department)
  {
    return $department;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Department  $department
   * @return \Illuminate\Http\Response
   */
  public function edit(Department $department)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Department  $department
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Department $department)
  {
    $department->deptprefix = $request->deptprefix;
    $department->deptcode = $request->deptcode;
    $department->deptname = $request->deptname;
    $department->save();

    return $department;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Department  $department
   * @return \Illuminate\Http\Response
   */
  public function destroy(Department $department)
  {
    return $department->delete();
  }
}
