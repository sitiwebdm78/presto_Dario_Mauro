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

class GoogleVisionSafeSearch implements ShouldQueue
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
        $feature->setType(Feature\Type::SAFE_SEARCH_DETECTION);
        
        $request = new AnnotateImageRequest();
        $request->setImage($googleImage);
        $request->setFeatures([$feature]);
        
        $batchRequest = new BatchAnnotateImagesRequest();
        $batchRequest->setRequests([$request]);
        
        $responseBatch = $googleVisionClient->batchAnnotateImages($batchRequest);
        $responses = $responseBatch->getResponses();
        
        $googleVisionClient->close();
        
        $safeSearchAnnotation = $responses[0]->getSafeSearchAnnotation();
        
        $adult = $safeSearchAnnotation->getAdult();
        $spoof = $safeSearchAnnotation->getSpoof();
        $medical = $safeSearchAnnotation->getMedical();
        $violence = $safeSearchAnnotation->getViolence();
        $racy = $safeSearchAnnotation->getRacy();
        
        $likelihoodName = [
            'text-secondary bi bi-circle-fill',
            'text-success bi bi-check-circle-fill',
            'text-success bi bi-check-circle-fill',
            'text-warning bi bi-exclamation-circle-fill',
            'text-warning bi bi-exclamation-circle-fill',
            'text-danger bi bi-dash-circle-fill'
        ];
        
        $image->adult = $likelihoodName[$adult] ?? $adult;
        $image->spoof = $likelihoodName[$spoof] ?? $spoof;
        $image->medical = $likelihoodName[$medical] ?? $medical;
        $image->violence = $likelihoodName[$violence] ?? $violence;
        $image->racy = $likelihoodName[$racy] ?? $racy;
        $image->save();
    }
}