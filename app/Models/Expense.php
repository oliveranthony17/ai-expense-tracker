<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    // Make it "fillable" - i.e. that I can create and assign the fields
    protected $fillable = [
        'amount',
        'title',
        'date',
        'description',
        'category',
    ];

    // Define the data types for the fields
    protected $casts = [
        'date' => 'date',
    ];
}
