<?php

namespace App\Http\Controllers\Admin\Demo;

class DemoReportController
{

    protected $prefix = 'admin/demo/report';

    /**
     * 图表插件
     */
    public function echarts()
    {
        return view($this->prefix."/echarts");
    }

    /**
     */
    public function peity()
    {
        return view($this->prefix."/peity");
    }

    /**
     * 线状图插件
     */
    public function sparkline()
    {
        return view($this->prefix."/sparkline");
    }

    /**
     * 图表组合
     */
    public function metrics()
    {
        return view($this->prefix."/metrics");
    }

}
