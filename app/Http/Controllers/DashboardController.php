<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    private $data = [];

    public function __construct()
    {
        $this->data['menu_active'] = 'dashboard';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->data;

        return view('dashboard.index', $data);
    }
}
