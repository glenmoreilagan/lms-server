<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

use App\Models\Leave;

class LeaveController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return Leave::with(['leavetype', 'employee'])->get();
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
    $leave = new Leave();
    // $leave->emp_id = $request->emp_id; // change to logged employeeid
    $leave->emp_id = rand(1,50); // change to logged employeeid
    $leave->start_date = $request->start_date;
    $leave->end_date = $request->end_date;
    $leave->leavetype_id = $request->leavetype_id;
    $leave->reason = $request->reason;
    $leave->save();

    if(!$leave) 
    {
      return response()->json(['status' => false, 'message' => 'Save Failed!']);
    }

    return response()->json(['status' => true, 'message' => 'Save Success!']);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Leave  $leave
   * @return \Illuminate\Http\Response
   */
  public function show(Leave $leave)
  {
    return $leave;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Leave  $leave
   * @return \Illuminate\Http\Response
   */
  public function edit(Leave $leave)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Leave  $leave
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Leave $leave)
  {
    $leave->emp_id = $request->emp_id; // change to logged employeeid
    $leave->start_date = $request->start_date;
    $leave->end_date = $request->end_date;
    $leave->leavetype_id = $request->leavetype_id;
    $leave->reason = $request->reason;
    $leave->save();

    if(!$leave) 
    {
      return response()->json(['status' => false, 'message' => 'Update Failed!']);
    }

    return response()->json(['status' => true, 'message' => 'Update Success!']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Leave  $leave
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $leave = Leave::find($id);
    $leave->delete();

    if(!$leave) 
    {
      return response()->json(['status' => false, 'message' => 'Delete Failed!']);
    }

    return response()->json(['status' => true, 'message' => 'Delete Success!']);
  }

  public function approveLeave(Request $request, $id)
  {
    $leave = Leave::where(['id' => $id])->update(['status' => 1]);

    if(!$leave) 
    {
      return response()->json(['status' => false, 'message' => 'Approve Failed!']);
    }

    return response()->json(['status' => true, 'message' => 'Approve Success!']);
  }
}
