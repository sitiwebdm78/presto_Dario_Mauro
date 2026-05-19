<?php
namespace App\Jobs;

use App\Models\Image;
use Spatie\Image\Enums\Fit;
use Google\Cloud\Vision\V1\Feature;
use Spatie\Image\Enums\AlignPosition;
use Spatie\Image\Image as SpatieImage;
use Google\Cloud\Vision\V1\Feature\Type;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\Image as VisionImage;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;


class RemoveFaces implements ShouldQueue
{
    use Queueable;

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
        
        $src = storage_path("app/public/" . $image->path);
        $imageContent = file_get_contents($src);
        
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path("google_credential.json"));
        
        $googleVisionClient = new ImageAnnotatorClient();
        
        $googleImage = new VisionImage();
        $googleImage->setContent($imageContent);
        
        $feature = new Feature();
        $feature->setType(Type::FACE_DETECTION);
        
        $request = new AnnotateImageRequest();
        $request->setImage($googleImage);
        $request->setFeatures([$feature]);
        
        $batchRequest = new BatchAnnotateImagesRequest();
        $batchRequest->setRequests([$request]);
        
        $responseBatch = $googleVisionClient->batchAnnotateImages($batchRequest);
        $response = $responseBatch->getResponses()[0];
        
        $faces = $response->getFaceAnnotations();
        
        foreach ($faces as $face) {
            $vertices = $face->getBoundingPoly()->getVertices();
            $bounds = [];
            
            foreach ($vertices as $vertex) {
                $bounds[] = [$vertex->getX(), $vertex->getY()];
            }
            
            $w = $bounds[2][0] - $bounds[0][0];
            $h = $bounds[2][1] - $bounds[0][1];
            
            $spatieImage = SpatieImage::load($src);
            $spatieImage->watermark(
                base_path("resources/img/face.png"),
                AlignPosition::TopLeft,
                paddingX: $bounds[0][0],
                paddingY: $bounds[0][1],
                width: $w,
                height: $h,
                fit: Fit::Stretch
            );
            $spatieImage->save($src);
        }
        
        $googleVisionClient->close();
    }
}