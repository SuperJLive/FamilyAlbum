<?php

namespace App\Http\Controllers;

use App\BLL\Downloadable;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use App\Models\AlbumOwner;
use App\Models\Permission;
use App\Utility\PermissionDic;
use App\Utility\Guid;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Image\MediaFile;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($albumId)
    {
        //
        //$albumId=$request->
        $pd=new PermissionDic();
        $permissions=$pd->getPhotoPermissionSelect($albumId);
        $uploadMaxFilesize=((float)str_replace('M','',ini_get('upload_max_filesize')))*1024;
        $postMaxSize=((float)str_replace('M','',ini_get('post_max_size')))*1024;
        $maxFileSize=$uploadMaxFilesize<=$postMaxSize?$uploadMaxFilesize:$postMaxSize;
        return view('Admin.Photo.Index',['permissions'=>$permissions,
                                            'albumId'=>$albumId,
                                            'uploadMaxFilesize'=>$maxFileSize
                                        ]);
    }
    /**
     *
     */
    public function getPermissionSelect($albumId)
    {
        //get parent permission
        $data=Album::from('album as a')->join('AlbumOwner as b','a.owner_id','b.id')
        ->where('a.id','=',$albumId)->select('a.permission','a.shareable','a.downloadable',
        'b.permission as ownerPermission','b.shareable as ownerShareable','b.downloadable as ownerDownloadable')->first();
        if($data->permission==-1)
        {
            $permissionText=1;
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo 'create';
        //return view('Admin.Photo.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $fileName=Guid::gen();
        $albumId=$request->input("albumId");
        $query=Album::query()->where('id','=',$albumId);
        $album=$query->first();
        if($album===null)
        {
            return response()->json(['error'=>'上传的相册不存在']);
        }
        //save uploaded media file
        $uploadedFile = $request->file('mediaFile');
        $fileNameExt='.'.$uploadedFile->getClientOriginalExtension();
        $originName=$uploadedFile->getClientOriginalName();
        $fileName.=$fileNameExt;
        $destinationPath = 'upload/'.$album->owner_id .'/'.$album->id.'/';
        if(!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, 0777, true, true);
        }
        
        //get photo field
        $rule = [
            'title' => 'string|nullable|max:100',
            'albumId' => 'required|integer|min:1',
            'permission' => 'required|integer',
            'isShow'=>'required|boolean',
            'isCover'=>'required|boolean',
            'password' => 'string|nullable|max:20',
            'takeStamp' => 'date|nullable',
            'shareable' => 'required|integer|min:-1|max:1',
            'downloadable' => 'required|integer|min:-1|max:1',
            'description' => 'string|nullable|max:500'
        ];

        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            $errors=array();
            $messages=$validator->errors()->all();
            foreach($messages as $key=>$val){
                array_push($errors,$val);
            }

            return response()->json( ['error'=>$errors]);
        }
        $uploadedFile->move($destinationPath,$fileName);
        $newFilePath=$destinationPath.$fileName;
        $mediaFile=new MediaFile($newFilePath);
        $exifJson=$mediaFile->GetJsonExifInfo();
        $size=$mediaFile->getFileSize();
        $imageSize=$mediaFile->getImageSize();
        dd($imageSize);
        //dd($size.'|||'. $request->input('size'));

        
        //implode($array)
        //$current_encode = mb_detect_encoding(implode($aaaaa), array("ASCII","GB2312","GBK",'BIG5','UTF-8')); 
        
        //dd(json_last_error_msg());
        
        // checksum
        // size
        // exif
        $validated = $validator->validated();
        if($validated['title']===null)
        {
            $validated['title']=$originName;
        }
        $rowNum = Photo::create([
            'title' => $validated['title'],
            'album_id' => $validated['albumId'],
            'permission' => $validated['permission'],
            'password' => $validated['password'],
            'take_stamp'=> $validated['takeStamp'],
            'shareable' => $validated['shareable'],
            'downloadable' => $validated['downloadable'],
            'is_show'=> $validated['isShow'],
            'is_cover'=> $validated['isCover'],
            'description' => $validated['description'],
            'file_name'=>$fileName,
            'file_ext'=>$fileNameExt,
            'file_path'=>$destinationPath,
            'origin_name'=>$originName
        ]);
        return response()->json(['success'=>1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'show';
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
