<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Jobs\PushZaloJob;
use App\Upload\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    private $data = [];

    public function __construct()
    {
        $this->data['menu_active'] = 'upload';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['menu_active'] = 'upload';

        $data = $this->data;
        $data['data'] = [];

        return view('upload.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadRequest $request
     * @return Response
     */
    public function upload(UploadRequest $request)
    {
        $this->data['menu_active'] = 'preview';

        $content = Excel::toArray(new UploadFile, request()->file('file'));

        $data = $this->data;
        $data['data'] = $content[0];

        return view('upload.preview', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $input = $request->all();

        for ($i = 0; $i < sizeof($input['phone']); $i++) {
            $data[$i]['phone'] = $input['phone'][$i];
            $data[$i]['message'] = $input['message'][$i];
        }

        $pushZaloJob = new PushZaloJob($data);
        dispatch($pushZaloJob)->delay(now()->addMinute(1));

    }

}
