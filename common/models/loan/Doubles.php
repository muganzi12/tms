<?php

/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 8/1/2017
 * Time: 11:33 PM
 */

namespace common\models\loan;

class Doubles {

    const DICIMAL = 0.000001;

    /**
     * @param $d1 double
     * @param $d2 double
     *
     * @return integer
     */
    public static function compare($d1, $d2) {
        $val = $d1 - $d2;
        if (abs($val) < Doubles::DICIMAL) {
            return 0;
        } else if ($val > 0) {
            return 1;
        } else {
            return -1;
        }
    }

}
