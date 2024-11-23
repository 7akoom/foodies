<?php

namespace App\Services;

class RespondService
{
    public function respondRedirect($route, $type, $msg)
    {
        return \redirect()->route($route)->with($type, $msg);
    }

    public function respondBack($type, $msg)
    {
        return \redirect()->back()->with($type, $msg);
    }
}