<?php

class Files extends  Model{



    public function saveOfersImagens($id_ofer, $files)
    {
        $flag = true;

        $file = new Files();
        $names = $file->SaveMFile($files, 'ofertas');
        if ($names != false) {
            if (is_array($names)) {
                $pf = new PrFiles();

                foreach ($names as $key => $id_foto) {
                    if ($key == 0) {
                        $prd = new Prds();
                        $prd->updatePrFoto($id_ofer, $id_foto);
                    }
                    if (!is_numeric($pf->savePrFoto($id_ofer, $id_foto))) {
                        return false;
                    }
                }
            } else {
                $flag = false;
            }
        } else {
            $flag = false;
        }
        //dnd($flag);

        return $flag;

    }


    public function __construct(){
        $table = 'files';
        parent::__construct($table);
    }


    public static function UploadAFile($pasta, $ajax=null, $files){
        if($ajax == null){
            $ajax = "files";
        }else{
            $ajax = $ajax . "files";// " ../../";

        }
        $f_name = $files['name'];

        $f_name = str_getcsv($f_name,".");




        $f_name = $f_name[count($f_name)-1];


        $f_name = rand(1000, 100000) . time() . rand(1000, 100000).".". $f_name;
        //rename the file




        $f_tname = $files['tmp_name'];

        if(move_uploaded_file($f_tname,"$ajax/$pasta/". $f_name)){
            self::resize("$ajax/$pasta/". $f_name);
            self::image_fix_orientation("$ajax/$pasta/". $f_name);
        }else{
            $f_name = false;
        }


        return $f_name;
    }

    public function SaveAFile($files, $pasta = ''){

        $form['file_name'] = self::UploadAFile($pasta,'',$files);
        if( $form['file_name'] !== false){
            $this->save($form);
            return $this->_db->lastID();
        }
       return false;
    }
    public function SaveMFile($files, $pasta = ''){
        $names = array();
        foreach($files['name'] as $key => $file_name){
            $toupload = array();
            $toupload['name'] = $files['name'][$key];
            $toupload['tmp_name'] = $files['tmp_name'][$key];
            $id = '';
            $form['file_name'] = self::UploadAFile($pasta,'',$toupload);
            if($form['file_name'] !== false){
                $this->save($form);
                $id = $this->_db->lastID();
            }

            if(!is_numeric($id)){
                return false;
            }else{
                $names[] = $id;
            }

        }
        if(empty($names)){
            return false;
        }
        return $names;
    }
    public static function  resize($file = null){

        $fileName = $file;
        $kaboom = explode(".", $fileName); // Split file name into an array using the dot
        $fileExt = end($kaboom);
        $target_file = $fileName;
        if(file_exists($target_file)){
            if(filesize($target_file) > 100000){
                $resized_file = $fileName;
                $data = getimagesize($target_file);
                $wmax = $data[0] < 2000 ? $data[0] : 2000;
                $hmax = $data[1]  < 2000 ? $data[1] : 2000;

                self::ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
            }
        }
    }

// Function for resizing jpg, gif, or png image files
    public static function ak_img_resize($target, $newcopy, $w, $h, $ext) {
        list($w_orig, $h_orig) = getimagesize($target);
        $scale_ratio = $w_orig / $h_orig;
        if (($w / $h) > $scale_ratio) {
            $w = $h * $scale_ratio;
        } else {
            $h = $w / $scale_ratio;
        }
        $img = "";
        $ext = strtolower($ext);
        if ($ext == "gif"){
            $img = imagecreatefromgif($target);
        } else if($ext =="png"){
            $img = imagecreatefrompng($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }
        $tci = imagecreatetruecolor($w, $h);
        // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
        imagejpeg($tci, $newcopy, 80);
    }

    public static function image_fix_orientation($filename) {
        $exif = @exif_read_data($filename);
        if (!empty($exif['Orientation'])) {
            $image = imagecreatefromjpeg($filename);
            switch ($exif['Orientation']) {
                case 3:
                    $image = imagerotate($image, 180, 0);
                    break;

                case 6:
                    $image = imagerotate($image, -90, 0);
                    break;

                case 8:
                    $image = imagerotate($image, 90, 0);
                    break;
            }

            imagejpeg($image, $filename, 90);
        }
    }



}