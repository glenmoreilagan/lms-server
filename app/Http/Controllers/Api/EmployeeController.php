<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $employee = DB::table('tbl_employees as emp')
      ->join('tbl_departments as dept', 'dept.id', '=', 'emp.dept_id')
      ->select(['emp.*', 'dept.deptcode', 'dept.deptname'])
      ->get();

    return $employee;
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
      'password' => 'required|string|',
      // 'file*' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    $employee = new Employee();
    $employee->empcode = 'EM-' . Str::random(5);
    $employee->empname = $fields['empname'];
    $employee->address = $request->address;
    $employee->phone = $request->phone;
    $employee->email = $fields['email'];
    $employee->dept_id = $request->dept_id;
    // $employee->image = $request->fileName;
    $employee->save();

    $this->saveImage($employee->id, $request);

    if (!$employee) {
      return response()->json(['status' => false, 'message' => 'Save Failed!']);
    }

    $user = User::create([
      'emp_id' => $employee->id,
      'name' => $fields['empname'],
      'email' => $fields['email'],
      'password' => bcrypt($fields['password']),
      'is_employee' => 1,
    ]);

    if ($user) {
      $user->createToken($user->name . 'Token')->plainTextToken;
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
    $employee = DB::table('tbl_employees as emp')
      ->where(['emp.id' => $employee->id])
      ->join('tbl_departments as dept', 'dept.id', '=', 'emp.dept_id')
      ->select(['emp.*', 'dept.deptcode', 'dept.deptname'])
      ->get();

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
      // 'password' => 'required|string|'
    ]);

    $employee->empcode = 'EM-' . Str::random(5);
    $employee->empname = $fields['empname'];
    $employee->address = $request->address;
    $employee->phone = $request->phone;
    $employee->email = $fields['email'];
    $employee->dept_id = $request->dept_id;
    $employee->save();

    $this->saveImage($employee->id, $request);

    if (!$employee) {
      return response()->json(['status' => false, 'message' => 'Update Failed!']);
    }

    $user = User::where(['emp_id' => $employee->id])
    ->update([
      'name' => $fields['empname'],
      'email' => $fields['email'],
      // 'password' => bcrypt($fields['password']),
    ]);

    if (!$user) {
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

    if (!$delete) {
      return response()->json(['status' => false, 'message' => 'Delete Failed!']);
    }
    return response()->json(['status' => true, 'message' => 'Delete Success!']);
  }

  public function saveImage($emp_id, $request)
  {
    $old_image = Employee::findOrFail($emp_id);
    if($request->has('file') && !empty($request->file('file')))
    {
      // todo/to fix
      // delete previous file/image and update new image
      // File::delete($old_image->image);
      $file_path = $request->file('file')->store('employee_images');
      $employee_update_image = Employee::find($emp_id);
      $employee_update_image->image = $file_path;
      $employee_update_image->save();
    }
  }
}
