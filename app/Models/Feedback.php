<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name', 'contact', 'person_type', 'related_to', 'rating', 'comments',
    'testimonial_consent', 'show_as_testimonial',
])]
class Feedback extends Model
{
    protected $table = 'feedbacks';
}
