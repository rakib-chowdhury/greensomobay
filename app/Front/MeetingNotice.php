<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class MeetingNotice extends Model
{
    protected $id = 'id';

    protected $table = 'meeting_notices';

    protected $fillable = ['title', 'notice', 'notice_file'];
}
