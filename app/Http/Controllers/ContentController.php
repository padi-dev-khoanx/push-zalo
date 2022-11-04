<?php

namespace App\Http\Controllers;

use App\Repositories\ContentRepository;
use Yajra\DataTables\Facades\DataTables;

class ContentController extends Controller
{
    private $data = [];

    protected $repository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->data['menu_active'] = 'users';
        $this->repository = $contentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('history.index', $this->data);
    }

    public function get()
    {
        return DataTables::of($this->repository->queryHistory())
            ->escapeColumns([])
            ->editColumn('id', function ($item) {
                return '#' . $item->id;
            })
            ->make(true);
    }

}
