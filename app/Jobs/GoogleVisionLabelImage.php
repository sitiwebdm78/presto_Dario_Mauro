<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image as VisionImage;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Queueable;
    public $timeout = 180;
    public $backoff = [2, 5, 10];
    public $tries = 5;

    private $article_image_id;

    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    public function handle(): void
    {
        $image = Image::find($this->article_image_id);
        
        if (!$image) {
            return;
        }
        
        $imageContent = file_get_contents(storage_path("app/public/" . $image->path));
        
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path("google_credential.json"));
        
        $googleVisionClient = new ImageAnnotatorClient();
        
        $googleImage = new VisionImage();
        $googleImage->setContent($imageContent);
        
        $feature = new Feature();
        $feature->setType(Feature\Type::LABEL_DETECTION);
        
        $request = new AnnotateImageRequest();
        $request->setImage($googleImage);
        $request->setFeatures([$feature]);
        
        $batchRequest = new BatchAnnotateImagesRequest();
        $batchRequest->setRequests([$request]);
        
        $responseBatch = $googleVisionClient->batchAnnotateImages($batchRequest);
        $response = $responseBatch->getResponses()[0];
        
        $labels = $response->getLabelAnnotations();
        
        if ($labels) {
            $result = [];
            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }
            $image->labels = $result;
            $image->save();
        }
        
        $googleVisionClient->close();
    }
}