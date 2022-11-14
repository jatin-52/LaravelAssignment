<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ScoreBoardUserFactory;

class ScoreBoardUser extends Model
{
    use HasFactory;

    protected $table = 'score_board_user';

}
