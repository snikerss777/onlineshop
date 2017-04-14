<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use App\Advertisement;
use App\image;
use File;
use MyImage;

class ImageController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
    	$advertisement = Advertisement::findOrFail($id);
    	$images = Image::where('advertisement_id', $id)->get();    	

        return view( 'advertisement.uploadimages', compact('advertisement', 'images'));
    }

    /**
     * @param Storage $storage
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function store( Storage $storage, Request $request )
    {

        if ( $request->isXmlHttpRequest() )
        {
            $timestamp = $this->getFormattedTimestamp();

            $image = $request->file( 'image' );
            $imageIcon = $request->file( 'image' );
            $imageOriginal = $request->file( 'image' );
            
            $savedImageName = $this->getSavedImageName( $timestamp, $image, $request->input('advertisement_id'));
            $savedIconName = $this->getSavedIconName($timestamp, $image, $request->input('advertisement_id'));
            $savedOriginalName = $this->getSavedOriginalName($timestamp, $imageOriginal, $request->input('advertisement_id'));

            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );
            $iconUploaded = $this->uploadImage($imageIcon, $savedIconName, $storage);
            $originalUploaded = $this->uploadImage($imageOriginal, $savedOriginalName, $storage);
           
            $path = public_path('images/' . $savedIconName);
            MyImage::make($imageIcon->getRealPath())->fit(100, 100)->save($path);

            $path2 = public_path('images/' . $savedImageName);
            MyImage::make($image->getRealPath())->fit(640, 480)->save($path2);

            $inputs = $request->all();
            $inputs['src'] = $savedImageName;
            $inputs['icon_src'] = $savedIconName;
            $inputs['original_src'] = $savedOriginalName;
            $imageDb = Image::create($inputs);
            
            if ( $imageUploaded)
            {
                $data = [
                    'image_id' => $imageDb->id,
                    'original_name' => $image->getClientOriginalName()

                ];
                return json_encode( $data, JSON_UNESCAPED_SLASHES );
            }

            return "uploading failed";
        }


    }

    public function removeUpload($id, Request $request){
		if ( $request->isXmlHttpRequest() )
        {
	        $image = Image::findOrFail($id);
	        $advertisement = Advertisement::findOrFail($image->advertisement_id);
            if($advertisement->photo_id == $image->id){
                $advertisement->photo_id = null;
                $advertisement->save();
            }

	        $file_path = "images/".$image->src;
    		if(File::exists($file_path)){ 
    			File::delete($file_path); 
    			$image->delete();
				return "image removed";
    		}    			
				
	        return "removing failed";
        }
        return "remove upload" ;
    }


    /**
     * @param $image
     * @param $imageFullName
     * @param $storage
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadImage( $image, $imageFullName, $storage )
    {
        $filesystem = new Filesystem;
        return $storage->disk( 'image' )->put( $imageFullName, $filesystem->get( $image ) );
    }

   

    /**
     * @return string
     */
    protected function getFormattedTimestamp()
    {
        return str_replace( [' ', ':'], '-', Carbon::now()->toDateTimeString() );
    }

    /**
     * @param $timestamp
     * @param $image
     * @return string
     */
    protected function getSavedImageName( $timestamp, $image, $advertisement_id)
    {
        return $timestamp . '---'.$advertisement_id . "---" . $image->getClientOriginalName();
    }

    protected function getSavedIconName( $timestamp, $image, $advertisement_id)
    {
        return $timestamp . '---'.$advertisement_id . "---icon---" . $image->getClientOriginalName();
    }

    protected function getSavedOriginalName( $timestamp, $image, $advertisement_id)
    {
        return $timestamp . '---'.$advertisement_id . "---original---" . $image->getClientOriginalName();
    }
}
