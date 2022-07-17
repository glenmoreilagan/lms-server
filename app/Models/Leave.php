<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
  use HasFactory;
  protected $table = 'tbl_leaves';

  public function employee()
  {
    return $this->belongsTo(Employee::class, 'emp_id');
  }
  
  public function leavetype()
  {
    return $this->belongsTo(Leavetype::class, 'leavetype_id');
  }
}
