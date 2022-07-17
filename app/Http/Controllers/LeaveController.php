<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

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

    return $leave;
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

    return $leave;
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

    return $leave->delete();
  }
}
