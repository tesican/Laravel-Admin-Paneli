<?php

namespace Admin;

use View,
    Input,
    Request;

class HomeController extends DashboardController
{

    public function index()
    {
        $viewData = array(
            "activePage" => "home"
        );
        return View::make('admin.home', $viewData);
    }

}
