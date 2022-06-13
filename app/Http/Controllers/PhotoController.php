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
use App\Media\MediaFile;
use App\Media\ImageHandler;
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
        //query photo
        $query=Photo::query()->where('album_id','=',$albumId)->orderby('created_at');
        $photos=$query->get();
        //get max upload size
        $uploadMaxFilesize=((float)str_replace('M','',ini_get('upload_max_filesize')))*1024;
        $postMaxSize=((float)str_replace('M','',ini_get('post_max_size')))*1024;
        $maxFileSize=$uploadMaxFilesize<=$postMaxSize?$uploadMaxFilesize:$postMaxSize;
        return view('Admin.Photo.Index',['permissions'=>$permissions,
                                            'photos'=>$photos,
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
        $destinationPath = '//upload/'.$album->owner_id .'/'.$album->id.'/';
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
            'location'=>'string|nullable|max:20',
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
        //move upload file
        $uploadedFile->move($destinationPath,$fileName);
        $newFilePath=$destinationPath.$fileName;
        $mediaFile=new MediaFile($newFilePath);
        //get upoad file size
        $size=$mediaFile->getFileSize();
        //get image size
        $imageSize=$mediaFile->getImageSize();
        $width=0;$height=0;
        if($imageSize)
        {
            $width=$imageSize[0];
            $height=$imageSize[1];
        }
        //get exif json
        $exifJson=$mediaFile->GetJsonExifInfo($takeTime);
        //get check sum
        $checksum = sha1_file($newFilePath);
        //generate compression
        $imageHandle=new ImageHandler($newFilePath);
        $imageHandle->compress();

        $validated = $validator->validated();

        $rowNum = Photo::create([
            'title' => $validated['title'],
            'album_id' => $validated['albumId'],
            'permission' => $validated['permission'],
            'password' => $validated['password'],
            'take_stamp'=> $validated['takeStamp']==null?$takeTime:$validated['takeStamp'],
            'location'=>$validated['location'],
            'shareable' => $validated['shareable'],
            'downloadable' => $validated['downloadable'],
            'is_show'=> $validated['isShow'],
            'is_cover'=> $validated['isCover'],
            'description' => $validated['description'],
            'file_path'=>$destinationPath.$fileName,
            'origin_name'=>$originName,
            'width'=>$width,
            'height'=>$height,
            'size'=>$size,
            'checksum'=>$checksum,
            'exif'=>$exifJson
        ]);
        return response()->json(['success'=>$rowNum]);
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
