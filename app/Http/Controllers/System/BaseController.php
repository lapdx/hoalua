<?php

namespace App\Http\Controllers\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Http\Controllers\Controller;

class BaseController extends Controller {

    const STATUS_SUCCESSFUL = "successful";
    const STATUS_FAIL = "fail";

    /**
     * open dialog upload image from tinymce plugin
     * @return type
     */
    protected function tinymceImageDialog() {
        return view("/system/tinymce/upload_image_dialog");
    }

    /**
     * Using for upload image to tinymce content
     * @return type
     */
    protected function tinymceImageUpload(Request $request) {
        try {
            $file = $request->file("file_upload");

            $fileName = $this->storeImage($file, "news_content", $file->getClientOriginalName() . '-' . time(), 'path');
            return view("/system/tinymce/upload_image_success", array(
                        "fileName" => "/upload/" . $fileName,
            ));
        } catch (FileException $fe) {
            $response = array(
                'status' => 'fail',
                'message' => 'Xảy ra lỗi, vui lòng liên hệ bộ phận kĩ thuật để được xử lý.' . $fe->getMessage()
            );
            return response()->json($response);
        }
    }

    protected function getFriendlyString($text, $allowUnder = false) {
        static $charMap = array(
            "à" => "a", "ả" => "a", "ã" => "a", "á" => "a", "ạ" => "a", "ă" => "a", "ằ" => "a", "ẳ" => "a", "ẵ" => "a", "ắ" => "a", "ặ" => "a", "â" => "a", "ầ" => "a", "ẩ" => "a", "ẫ" => "a", "ấ" => "a", "ậ" => "a",
            "đ" => "d",
            "è" => "e", "ẻ" => "e", "ẽ" => "e", "é" => "e", "ẹ" => "e", "ê" => "e", "ề" => "e", "ể" => "e", "ễ" => "e", "ế" => "e", "ệ" => "e",
            "ì" => "i", "ỉ" => "i", "ĩ" => "i", "í" => "i", "ị" => "i",
            "ò" => "o", "ỏ" => "o", "õ" => "o", "ó" => "o", "ọ" => "o", "ô" => "o", "ồ" => "o", "ổ" => "o", "ỗ" => "o", "ố" => "o", "ộ" => "o", "ơ" => "o", "ờ" => "o", "ở" => "o", "ỡ" => "o", "ớ" => "o", "ợ" => "o",
            "ù" => "u", "ủ" => "u", "ũ" => "u", "ú" => "u", "ụ" => "u", "ư" => "u", "ừ" => "u", "ử" => "u", "ữ" => "u", "ứ" => "u", "ự" => "u",
            "ỳ" => "y", "ỷ" => "y", "ỹ" => "y", "ý" => "y", "ỵ" => "y",
            "À" => "A", "Ả" => "A", "Ã" => "A", "Á" => "A", "Ạ" => "A", "Ă" => "A", "Ằ" => "A", "Ẳ" => "A", "Ẵ" => "A", "Ắ" => "A", "Ặ" => "A", "Â" => "A", "Ầ" => "A", "Ẩ" => "A", "Ẫ" => "A", "Ấ" => "A", "Ậ" => "A",
            "Đ" => "D",
            "È" => "E", "Ẻ" => "E", "Ẽ" => "E", "É" => "E", "Ẹ" => "E", "Ê" => "E", "Ề" => "E", "Ể" => "E", "Ễ" => "E", "Ế" => "E", "Ệ" => "E",
            "Ì" => "I", "Ỉ" => "I", "Ĩ" => "I", "Í" => "I", "Ị" => "I",
            "Ò" => "O", "Ỏ" => "O", "Õ" => "O", "Ó" => "O", "Ọ" => "O", "Ô" => "O", "Ồ" => "O", "Ổ" => "O", "Ỗ" => "O", "Ố" => "O", "Ộ" => "O", "Ơ" => "O", "Ờ" => "O", "Ở" => "O", "Ỡ" => "O", "Ớ" => "O", "Ợ" => "O",
            "Ù" => "U", "Ủ" => "U", "Ũ" => "U", "Ú" => "U", "Ụ" => "U", "Ư" => "U", "Ừ" => "U", "Ử" => "U", "Ữ" => "U", "Ứ" => "U", "Ự" => "U",
            "Ỳ" => "Y", "Ỷ" => "Y", "Ỹ" => "Y", "Ý" => "Y", "Ỵ" => "Y"
        );

        $text = strtr($text, $charMap);

        $text = $this->cleanUpSpecialChars($text, $allowUnder);
        return strtolower($text);
    }

    private function cleanUpSpecialChars($text, $allowUnder = false) {
        $regExpression = "`\W`i";
        if ($allowUnder)
            $regExpression = "`[^a-zA-Z0-9-]`i";

        $text = preg_replace(array($regExpression, "`[-]+`",), "-", $text);
        return trim($text, "-");
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function recordsCountToPagesCount($recordsCount, $pageSize) {
        $retVal = (int) ($recordsCount / $pageSize);
        if ($recordsCount % $pageSize > 0) {
            $retVal++;
        }
        //return
        return $retVal;
    }

    /**
     * Store image and create images with differrent sizes (l,m,s)
     * This method will create 1 subdirectory for image storage each 10 days
     * @param type $image
     * @param type array|string $sizes
     */
    protected function storeImage($image, $type = "parameter", $title = "", $return = 'file_name') {
        try {

            $mimeType = $image->getClientMimeType();
            if (!preg_match('/image/', $mimeType)) {
                throw new FileException("Only allowed to upload image");
            }

            //get-image-root-directory, create directory if it doesn't exist
            $rootImageDirectoryPath = $this->getParameter("rootImageDirectory.path", public_path() . DIRECTORY_SEPARATOR . "upload");
            if (!file_exists($rootImageDirectoryPath)) {
                mkdir($rootImageDirectoryPath);
            }

            $imageDirectoryName = $type;

            $year = date('Y');
            $month = date('m');
            $fileName = $this->getFriendlyString($title) . '-' . date("dmYHis") . '.' . strtolower($image->getClientOriginalExtension());
            if ($type == 'news_content') {
                $pathFile = "news/content/{$year}/{$month}/{$fileName}";
            } else {
                $pathFile = "{$type}/{$year}/{$month}/{$fileName}";
            }

            if ($type == "news_content") {
                $imageDirectoryPath = $rootImageDirectoryPath . DIRECTORY_SEPARATOR . "news";
                if (!\File::isDirectory($imageDirectoryPath)) {
                    \File::makeDirectory($imageDirectoryPath, 0777);
                }
                $imageDirectoryPath = $rootImageDirectoryPath . DIRECTORY_SEPARATOR . "news" . DIRECTORY_SEPARATOR . 'content';
            } else {
                $imageDirectoryPath = $rootImageDirectoryPath . DIRECTORY_SEPARATOR . $imageDirectoryName;
            }

            //stored in the form "upload/category/{year}/{month}/image_file"
            if (!\File::isDirectory($imageDirectoryPath)) {
                \File::makeDirectory($imageDirectoryPath, 0777);
            }
            if (!\File::isDirectory($imageDirectoryPath . DIRECTORY_SEPARATOR . $year)) {
                \File::makeDirectory($imageDirectoryPath . DIRECTORY_SEPARATOR . $year, 0777);
            }
            if (!\File::isDirectory($imageDirectoryPath . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month)) {
                \File::makeDirectory($imageDirectoryPath . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month, 0777);
            }
            $imageDirectoryPath = $imageDirectoryPath . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month;
            $image->move($imageDirectoryPath, $fileName);

            //return
            if ($return == 'path') {
                return $pathFile;
            }
            return $fileName;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    protected function getParameter($key, $defaultValue = null) {
        $retVal = $defaultValue;
        $parameter = DB::table('parameter')->where("param_key", "=", $key)
                ->first();
        if ($parameter != null) {
            $retVal = $parameter->param_value;
        }
        return $retVal;
    }
}
