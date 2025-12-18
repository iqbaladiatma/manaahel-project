<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoProxyController extends Controller
{
    /**
     * Proxy video requests to bypass CORS issues
     */
    public function proxy(Request $request)
    {
        $videoUrl = $request->query('url');
        
        if (!$videoUrl || !filter_var($videoUrl, FILTER_VALIDATE_URL)) {
            return response('Invalid URL', 400);
        }
        
        // Only allow Cloudinary URLs for security
        if (!str_contains($videoUrl, 'cloudinary.com')) {
            return response('Only Cloudinary URLs allowed', 403);
        }
        
        try {
            // Get video content
            $context = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                        'Accept: video/*,*/*;q=0.9',
                        'Accept-Encoding: identity',
                        'Connection: keep-alive'
                    ],
                    'timeout' => 30
                ]
            ]);
            
            $videoContent = file_get_contents($videoUrl, false, $context);
            
            if ($videoContent === false) {
                return response('Failed to fetch video', 500);
            }
            
            // Get content type from headers
            $contentType = 'video/mp4'; // Default
            if (isset($http_response_header)) {
                foreach ($http_response_header as $header) {
                    if (stripos($header, 'content-type:') === 0) {
                        $contentType = trim(substr($header, 13));
                        break;
                    }
                }
            }
            
            return response($videoContent)
                ->header('Content-Type', $contentType)
                ->header('Accept-Ranges', 'bytes')
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, HEAD, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Range, Content-Range, Content-Length')
                ->header('Cache-Control', 'public, max-age=3600');
                
        } catch (\Exception $e) {
            return response('Error fetching video: ' . $e->getMessage(), 500);
        }
    }
    
    /**
     * Stream video with range support for better playback
     */
    public function stream(Request $request)
    {
        $videoUrl = $request->query('url');
        
        if (!$videoUrl || !filter_var($videoUrl, FILTER_VALIDATE_URL)) {
            return response('Invalid URL', 400);
        }
        
        if (!str_contains($videoUrl, 'cloudinary.com')) {
            return response('Only Cloudinary URLs allowed', 403);
        }
        
        try {
            // Get video headers first
            $headers = get_headers($videoUrl, 1);
            $contentLength = $headers['Content-Length'] ?? 0;
            $contentType = $headers['Content-Type'] ?? 'video/mp4';
            
            // Handle range requests for video streaming
            $range = $request->header('Range');
            
            if ($range) {
                // Parse range header
                preg_match('/bytes=(\d+)-(\d*)/', $range, $matches);
                $start = intval($matches[1]);
                $end = $matches[2] ? intval($matches[2]) : $contentLength - 1;
                
                // Create range context
                $context = stream_context_create([
                    'http' => [
                        'method' => 'GET',
                        'header' => [
                            "Range: bytes={$start}-{$end}",
                            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                        ]
                    ]
                ]);
                
                $content = file_get_contents($videoUrl, false, $context);
                
                return response($content, 206)
                    ->header('Content-Type', $contentType)
                    ->header('Accept-Ranges', 'bytes')
                    ->header('Content-Range', "bytes {$start}-{$end}/{$contentLength}")
                    ->header('Content-Length', $end - $start + 1)
                    ->header('Access-Control-Allow-Origin', '*');
            } else {
                // Full video request
                $content = file_get_contents($videoUrl);
                
                return response($content)
                    ->header('Content-Type', $contentType)
                    ->header('Accept-Ranges', 'bytes')
                    ->header('Content-Length', strlen($content))
                    ->header('Access-Control-Allow-Origin', '*');
            }
            
        } catch (\Exception $e) {
            return response('Error streaming video: ' . $e->getMessage(), 500);
        }
    }
}
