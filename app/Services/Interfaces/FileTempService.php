<?php

namespace App\Services\Interfaces;

interface FileTempService
{
    /**
     * Summary of uploadTemp
     * 
     * handle file upload to temp
     * @return string|bool
     */
    function uploadTemp(\Illuminate\Http\Request $request);

    /**
     * Summary of revertTemp
     * 
     * handle file revert in temp
     * @return bool
     */
    function revertTemp(\Illuminate\Http\Request $request): bool;

    /**
     * Summary of saveFileTemp
     * 
     * menyimpan file dari lokasi temps, jika berhasil maka akan mendapatkan
     * path file
     * @param string $tempFolder
     * @param string $targetFolder
     * @return string|bool
     */
    function saveFileTemp(string $tempFolder, string $targetFolder): bool|string;
}