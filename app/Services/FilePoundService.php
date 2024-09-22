<?php

namespace App\Services;
use App\Models\TempFile;
use App\Services\Interfaces\FileTempService;
use DB;
use Log;
use Storage;

class FilePoundService implements FileTempService
{

    private const TEMP_PATH = "temp/";

    public function uploadTemp(\Illuminate\Http\Request $request)
    {
        Log::debug("request", [$request->all()]);

        foreach ($request->allFiles() as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    $folder = rand();
                    $file   = \Illuminate\Support\Str::random() . "-" . $item->getClientOriginalName();
                    Storage::disk("public")->putFileAs(FilePoundService::TEMP_PATH . $folder, $item, $file);
                    TempFile::create([
                        'folder' => $folder,
                        'file' => $file,
                        'user_id' => $request->user()->id
                    ]);

                    return $folder;
                }
            } else {
                $folder = rand();
                $file   = \Illuminate\Support\Str::random() . "-" . $request->file($key)->getClientOriginalName();
                Storage::disk("public")->putFileAs(FilePoundService::TEMP_PATH . $folder, $request->file($key), $file);
                TempFile::create([
                    'folder' => $folder,
                    'file' => $file,
                    'user_id' => $request->user()->id
                ]);

                return $folder;
            }
        }

        return false;

    }

    public function revertTemp(\Illuminate\Http\Request $request): bool
    {
        $temp = TempFile::where('folder', $request->getContent())->first();
        Storage::disk('public')->deleteDirectory(FilePoundService::TEMP_PATH . $request->getContent());
        $temp->delete();

        return true;
    }

    public function saveFileTemp(string $tempFolder, string $targetFolder): bool|string
    {
        $temp = TempFile::where('folder', $tempFolder)->first();
        if ($temp) {
            $targetPath = "$targetFolder/$temp->file";

            if (Storage::disk("public")->move(FilePoundService::TEMP_PATH . "/" . "$temp->folder/$temp->file", $targetPath)) {
                Storage::disk("public")->deleteDirectory(FilePoundService::TEMP_PATH . "/" . $temp->folder);
                $temp->delete();
            }

            return $targetPath;
        }

        return false;
    }
}