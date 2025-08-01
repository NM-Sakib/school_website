<?php

namespace App\Http\Controllers\Administrative;

use Log;
use Exception;
use App\Models\User;
use Mpdf\Tag\Summary;
use App\Models\Upload;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\BeSearch;
use App\Models\FeSearch;
use App\Models\Instance;
use App\Models\GuestUser;
use App\Models\ScanHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            return view('administrative.dashboard.dashboard');
        } catch (\Throwable $th) {
            $payload = [
                'code' => 500,
                'app_message' => 'Something went wrong.',
                'user_message' => 'Something went wrong.',
                'data' => $th->getMessage()
            ];
            return response()->json($payload, 500);
        }
    }



    public function getNotificationCount()
    {
        $data = User::find(Auth::id());

        $count = count(User::find(Auth::id())->notifications->where('is_read',  '0'));
        $data = [
            'count' => $count,
        ];

        return response()->json($data, 200);
    }

    public function getNotification(Request $request)
    {
        $data = User::find(Auth::id());
        $result = $data->notifications->where('is_read',  '0');
        $result = $result->sortByDesc('created_at');

        return View('administrative.layouts.notification', compact('result'))->render();
    }

    public function uploadImage(Request $request)
    {
        $type = array(
            "jpg" => "image",
            "jpeg" => "image",
            "png" => "image",
            "svg" => "image",
            "webp" => "image",
            "gif" => "image",
            "mp4" => "video",
            "mpg" => "video",
            "mpeg" => "video",
            "webm" => "video",
            "ogg" => "video",
            "avi" => "video",
            "mov" => "video",
            "flv" => "video",
            "swf" => "video",
            "mkv" => "video",
            "wmv" => "video",
            "wma" => "audio",
            "aac" => "audio",
            "wav" => "audio",
            "mp3" => "audio",
            "zip" => "archive",
            "rar" => "archive",
            "7z" => "archive",
            "doc" => "document",
            "txt" => "document",
            "docx" => "document",
            "pdf" => "document",
            "csv" => "document",
            "xml" => "document",
            "ods" => "document",
            "xlr" => "document",
            "xls" => "document",
            "xlsx" => "document"
        );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/all', $imageName, 'public');

            $upload = new Upload;
            $extension = strtolower($request->file('image')->getClientOriginalExtension());
            try {
                $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

                $image = $manager->read($request->file('image')->getRealPath());

                $height = $image->height();
                $width = $image->width();

                if ($width > $height && $width > 1500) {
                    $image = $image->resize(width: 1500);
                } elseif ($height > 1500) {
                    $image = $image->resize(height: 800);
                }
                $image = $image->toJpeg();
                $pathToSave = base_path('public/' . $path);
                file_put_contents($pathToSave, (string) $image);
                clearstatcache();
                $size = filesize($pathToSave);
            } catch (\Exception $e) {
            }

            $upload->extension = $extension;
            $upload->file_name = $path;
            $upload->user_id = Auth::user()->id;
            $upload->type = $type[$upload->extension];
            $upload->file_size = $size;
            $upload->save();

            return asset($path);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }

    public function search(Request $request)
    {
        $results = BeSearch::where('title', 'like', '%' . $request->q . '%')
            ->get(['title', 'page_link'])
            ->map(function ($item) {
                $item->page_link = env('APP_URL') . ltrim($item->page_link, '/');
                $item->title = str_replace(">", "<i class='ri-arrow-right-line align-middle text-info'></i>", $item->title);
                return $item;
            });

        return response()->json($results);
    }


    public function redisClear(Request $request)
    {
        try {
            Redis::connection()->client()->flushall();
        } catch (Exception $e) {
            // Optionally log the error for debugging
            Log::error('Redis flush failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Cache cleared successfully.');
    }
}
