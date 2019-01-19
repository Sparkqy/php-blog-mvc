<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 12.01.2019
 * Time: 17:04
 */

namespace MyProject\Services;


use MyProject\Exceptions\FileUploadException;

class ImageUploader
{
    private const EXTENSIONS = ['jpeg', 'png', 'jpg'];

    /**
     * @param array $fileData
     * @return bool
     * @throws FileUploadException
     */
    private static function isImageValid(array $fileData): bool
    {
        foreach ($fileData['name'] as $fileName) {
            @$fileExtension = strtolower(end(explode('.', $fileName)));

            if (!in_array($fileExtension, self::EXTENSIONS)) {
                throw new FileUploadException('This file extension is not allowed. Please upload a JPEG or PNG file.');
            }
        }

        foreach ($fileData['size'] as $fileSize) {
            if ($fileSize > 2000000) {
                throw new FileUploadException('This file is more than 2MB. Sorry, it has to be less than or equal to 2MB.');
            }
        }

        return true;
    }

    public function uploadImage(array $fileData)
    {
        $isValid = ImageUploader::isImageValid($fileData);

        if ($isValid && $_POST) {
            $currentDir = getcwd();
            $uploadDir = "/images/articles/";

            // preparing array for uploading

            $uploads = [];
            foreach ($fileData as $key => $file) {
                if ($key == 'name') {
                    foreach ($file as $key => $fileName) {
                        $uploads['file' . $key][] = $currentDir . $uploadDir . basename($fileName);
                    }
                }
                if ($key == 'tmp_name') {
                    foreach ($file as $key => $fileTmp) {
                        $uploads['file' . $key][] = $fileTmp;
                    }
                }
            }

            // uploading images
            foreach ($uploads as $upload) {
                $didUpload = move_uploaded_file($upload['1'], $upload['0']);

                if (!$didUpload) {
                    throw new FileUploadException('An error occurred while image uploading. Try again or contact the admin');
                }
            }
        }
    }
}