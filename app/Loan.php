<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function status()
    {
        $status = '';
        switch ($this->step) {
            case 0:
                $status = 'Application';
                break;
            case 5:
                $status = 'Completed';
                break;
            default:
                $status = 'Processing';
        }

        return $status;
    }
}
