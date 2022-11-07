<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Jobs\PushZaloJob;
use App\Upload\UploadFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
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
     * @return Response
     */
    public function index()
    {
        $this->data['menu_active'] = 'upload';

        $data = $this->data;
        $data['data'] = [];

        return view('upload.index', $data);
    }

    public function uploadIndex()
    {
        return Redirect::route('upload.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadRequest $request
     * @return Response
     */
    public function preview(UploadRequest $request)
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
     * @param Request $request
     * @return RedirectResponse
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

        return Redirect::route('upload.index')->with('notice_success', 'Đã gửi tin nhắn thành công!');
    }

}
