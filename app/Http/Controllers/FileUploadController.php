<?php

namespace App\Http\Controllers;

use Validator;
use Storage;
use App\Models\File;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:files-create')->only('store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'file' => 'required|max:10240',
        ]);

        if ($validator->fails()) {          
            return response()->json(['success' => 0, 'messages' => $validator->messages()], 400);                        
        }

        if ($file = $request->file('file')) {
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();

            $data = new File();
            $data->name = $name;
            $data->path= $path;
            $data->size= $file->getSize();
            $data->type= $file->getClientMimeType();
            $data->save();
                
            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => Storage::url($path),
                    'name' => $name,
                    'title' => $name,
                    'size' => $data->size,
                    'type' => $data->type,
                    'extension' => $file->getClientOriginalExtension(),
                ]
            ]);
        }
    }
}
