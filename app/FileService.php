<?php

namespace App;

use Illuminate\Http\UploadedFile;
use Image;

trait FileService
{
    /**
     * @var array
     */
    private $options = [
    	'width'     => 200,
    	'height'    => 200,
    	'grayscale' => false
    ];
    
    /**
     * @var string
     */
    private $path = 'uploads';
    
    /**
     * Set default options
     * 
     * @param array $options
     * @return $this
     */
    private function setOptions(array $options)
    {
        if (isset($options['width'])) {
            $this->options['width'] = $options['width'];
        }
        
        if (isset($options['height'])) {
            $this->options['height'] = $options['height'];
        }
        
        if (isset($options['grayscale'])) {
            $this->options['grayscale'] = $options['grayscale'];
        }
        
        return $this;
    }
    
    /**
     * Set default path
     * 
     * @param string $path
     * @return $this
     */
    private function setPath(string $path)
    {
        $this->path = $path;
        
        return $this;
    }
    
    /**
     * Upload one file
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param boolean $thumb
     * @return string
     */
    private function uploadFile(UploadedFile $file, string $path = '', $thumb = false) : string
    {
        $filename = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
        
        $file->move($this->getPath() . $path, $filename);
        
        if ($thumb) {
            Image::make($this->getPath() . $path . '/' . $filename, $this->options)
                 ->save($this->getPath(true) . $path . '/thumbnail/' . $filename);
        }
        
        return $filename;
    }
    
    /**
     * Remove one image
     * 
     * @param string $filename
     * @param string $path
     * @param boolean $thumb
     * @return void
     */
    private function removeFile(string $filename, string $path = '', $thumb = false)
    {
        if (file_exists($this->getPath() . $path . '/' . $filename)) {
            unlink($this->getPath() . $path . '/' . $filename);
        }
        
        if ($thumb) {
            if (file_exists($this->getPath() . $path . '/thumbnail/' . $filename)) {
                unlink($this->getPath() . $path . '/thumbnail/' . $filename);
            }
        }
    }
    
    /**
     * Get path uploads
     * 
     * @return string
     */
    private function getPath(bool $public_path = false)
    {
        if ($public_path) {
            return public_path($this->path);
        } else {
            return $this->path;
        }
    }
}