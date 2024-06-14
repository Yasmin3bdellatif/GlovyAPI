<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ModelController extends Controller
{
    public function query(Request $request)
    {
        // التحقق من وجود الملف في الطلب
        if ($request->hasFile('file')) {
            // الحصول على الكائن الممثل للملف
            $file = $request->file('file');

            // قراءة محتويات الملف
            $fileContents = file_get_contents($file->path());

            $apiUrl = "https://api-inference.huggingface.co/models/gianlab/swin-tiny-patch4-window7-224-finetuned-parkinson-classification";
            $headers = [
                "Authorization" => "Bearer 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",
            ];

            // إرسال طلب HTTP إلى واجهة برمجة التطبيقات
            $response = Http::withHeaders($headers)
                ->withBody($fileContents, $file->getClientOriginalName())
                ->post($apiUrl);

            // تأخير الاستجابة لمدة 25 ثانية
            sleep(30);

            return $response->json();
        } else {
            // في حالة عدم وجود الملف في الطلب
            return response()->json(['message' => 'No file uploaded'], 400);
        }
    }
}
