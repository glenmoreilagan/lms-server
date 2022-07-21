<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

use App\Models\Leavetype;
use Illuminate\Support\Facades\Auth;

class LeavetypeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return Leavetype::all();
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
    $leavetype = new Leavetype();
    $leavetype->leavedescription = $request->leavedescription;
    $leavetype->leavetype = $request->leavetype;
    $leavetype->save();

    if(!$leavetype) 
    {
      return response()->json(['status' => false, 'message' => 'Save Failed!']);
    }

    return response()->json(['status' => true, 'message' => 'Save Success!']);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Leavetype  $leavetype
   * @return \Illuminate\Http\Response
   */
  public function show(Leavetype $leavetype)
  {
    return $leavetype;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Leavetype  $leavetype
   * @return \Illuminate\Http\Response
   */
  public function edit(Leavetype $leavetype)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Leavetype  $leavetype
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Leavetype $leavetype)
  {
    $leavetype->leavedescription = $request->leavedescription;
    $leavetype->leavetype = $request->leavetype;
    $leavetype->save();

    if(!$leavetype) 
    {
      return response()->json(['status' => false, 'message' => 'Update Failed!']);
    }

    return response()->json(['status' => true, 'message' => 'Update Success!']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Leavetype  $leavetype
   * @return \Illuminate\Http\Response
   */
  public function destroy(Leavetype $leavetype)
  {
    $leavetype->delete();

    if(!$leavetype) 
    {
      return response()->json(['status' => false, 'message' => 'Delete Failed!']);
    }

    return response()->json(['status' => true, 'message' => 'Delete Success!']);
  }
}
