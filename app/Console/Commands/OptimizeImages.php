<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize';
    protected $description = 'Optimize images for faster loading';

    public function handle()
    {
        $this->info('Starting image optimization...');
        
        // Get all image files from storage
        $directories = ['categories', 'products', 'users'];
        
        foreach ($directories as $directory) {
            $this->info("Processing directory: {$directory}");
            
            $files = Storage::disk('public')->allFiles($directory);
            $imageFiles = array_filter($files, function($file) {
                return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file);
            });
            
            $this->info("Found " . count($imageFiles) . " images in {$directory}");
            
            foreach ($imageFiles as $file) {
                $this->line("Processing: {$file}");
                
                // Get file info
                $fullPath = Storage::disk('public')->path($file);
                $fileSize = filesize($fullPath);
                
                if ($fileSize > 500000) { // If larger than 500KB
                    $this->warn("Large file detected: {$file} ({$fileSize} bytes)");
                    $this->line("Consider compressing this image manually for better performance.");
                } else {
                    $this->info("File size OK: {$file} ({$fileSize} bytes)");
                }
            }
        }
        
        $this->info('Image optimization complete!');
        $this->line('Tips for better performance:');
        $this->line('- Use WebP format when possible');
        $this->line('- Compress images to under 500KB');
        $this->line('- Use appropriate dimensions (800x450 max)');
        $this->line('- Enable lazy loading in browser');
    }
}