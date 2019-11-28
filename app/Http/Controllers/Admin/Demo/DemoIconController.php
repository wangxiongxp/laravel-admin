<?php

namespace App\Http\Controllers\Admin\Demo;

class DemoIconController
{

    protected $prefix = 'admin/demo/icon';

    /**
     * FontAwesome图标
     */
    public function fontawesome()
    {
        return view($this->prefix."/fontawesome");
    }

    /**
     * Glyphicons图标
     */
    public function glyphicons()
    {
        return view($this->prefix."/glyphicons");
    }

}
