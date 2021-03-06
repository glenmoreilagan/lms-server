<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'empcode' => 'EM-'.Str::random(5),
      'empname' => fake()->name(),
      'address' => fake()->address(),
      'phone' => fake()->phoneNumber(),
      'email' => fake()->safeEmail(),
      'image' => ''
    ];
  }
}
