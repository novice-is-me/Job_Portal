<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    //

    public function download($userId, $type, $filename)
    {
        // Construct the file path in the 'public' storage
        $path = public_path("storage/{$userId}/{$type}/{$filename}");

        // Debugging
        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Return the file as a download response
        return Response::download($path);
    }


    public function delete(Request $request, $id)
    {
        // Normalize the file type to match database field names
        $fileType = Str::snake(trim($request->input('type'))); // Converts "coverLetter" -> "cover_letter"

        if ($fileType !== 'resume' && $fileType !== 'cover_letter') {
            return response()->json(['error' => 'Invalid file type: "' . $fileType . '"'], 400);
        }

        $user = User::find($id);

        if($fileType == 'resume'){
            $user->update([
                'resume' => null,
            ]);
        } else {
            $user->update([
                'cover_letter' => null,
            ]);
        }

        return response()->json(['message' => 'File deleted successfully']);
    }
}
