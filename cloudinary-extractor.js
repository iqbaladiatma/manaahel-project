// Cloudinary File Name Extractor - Enhanced Version
// Paste script ini di browser console saat buka Cloudinary Media Library

(function() {
    console.log('🚀 Cloudinary File Extractor Started (Enhanced)...');
    
    // Function to extract file names from current page
    function extractFileNames() {
        const fileNames = [];
        const publicIds = [];
        
        // Enhanced selectors for Cloudinary interface (2024 version) - Mosaic view support
        const selectors = [
            // Mosaic/Grid view selectors (most common in 2024)
            '[data-testid="media-library-asset"]',
            '[data-testid="asset-card"]', 
            '[data-testid="media-asset"]',
            '[data-testid="grid-item"]',
            '[data-testid="mosaic-item"]',
            '.media-library-asset',
            '.asset-card',
            '.asset-item', 
            '.media-item',
            '.grid-item',
            '.mosaic-item',
            '.thumbnail-container',
            '.asset-thumbnail',
            
            // Cloudinary specific classes (updated 2024)
            '.cld-media-library-asset',
            '.cld-asset-card',
            '.cld-grid-item',
            '[class*="MediaLibrary"]',
            '[class*="AssetCard"]',
            '[class*="GridItem"]',
            '[class*="Thumbnail"]',
            
            // Data attributes (most reliable)
            '[data-public-id]',
            '[data-asset-id]',
            '[data-resource-type]',
            '[data-media-type]',
            '[data-cloudinary-public-id]',
            
            // Image and video elements with Cloudinary URLs
            'img[src*="cloudinary.com"]',
            'video[src*="cloudinary.com"]', 
            'img[data-src*="cloudinary.com"]',
            'video[data-src*="cloudinary.com"]',
            'img[data-original*="cloudinary.com"]',
            'video[data-original*="cloudinary.com"]',
            
            // Elements with file extensions in various attributes
            '[title*=".jpg"]', '[title*=".jpeg"]', '[title*=".png"]', '[title*=".gif"]',
            '[title*=".mp4"]', '[title*=".avi"]', '[title*=".mov"]', '[title*=".webm"]', '[title*=".mkv"]',
            '[alt*=".jpg"]', '[alt*=".jpeg"]', '[alt*=".png"]', '[alt*=".gif"]',
            '[alt*=".mp4"]', '[alt*=".avi"]', '[alt*=".mov"]', '[alt*=".webm"]', '[alt*=".mkv"]',
            '[aria-label*=".jpg"]', '[aria-label*=".jpeg"]', '[aria-label*=".png"]', '[aria-label*=".gif"]',
            '[aria-label*=".mp4"]', '[aria-label*=".avi"]', '[aria-label*=".mov"]', '[aria-label*=".webm"]',
            
            // Generic containers that might have file info
            '[class*="asset"]',
            '[class*="media"]', 
            '[class*="file"]',
            '[class*="thumbnail"]',
            '[class*="card"]',
            '[class*="item"]'
        ];
        
        selectors.forEach(selector => {
            try {
                const elements = document.querySelectorAll(selector);
                console.log(`🔍 Selector "${selector}": found ${elements.length} elements`);
                
                elements.forEach(el => {
                    // Try to get filename from various attributes (expanded list)
                    let fileName = el.getAttribute('title') || 
                                  el.getAttribute('alt') || 
                                  el.getAttribute('data-filename') ||
                                  el.getAttribute('data-name') ||
                                  el.getAttribute('aria-label') ||
                                  el.getAttribute('data-original-filename') ||
                                  el.getAttribute('data-display-name');
                    
                    // Get public ID from multiple possible attributes
                    let publicId = el.getAttribute('data-public-id') ||
                                  el.getAttribute('data-asset-id') ||
                                  el.getAttribute('data-id') ||
                                  el.getAttribute('data-cloudinary-public-id') ||
                                  el.getAttribute('data-resource-id') ||
                                  el.getAttribute('id');
                    
                    // Get resource type for better file type detection
                    let resourceType = el.getAttribute('data-resource-type') ||
                                     el.getAttribute('data-media-type') ||
                                     el.getAttribute('data-type');
                    
                    // Extract from src attributes (expanded)
                    const srcAttrs = ['src', 'data-src', 'data-original', 'data-lazy', 'data-background-image', 'style'];
                    srcAttrs.forEach(attr => {
                        let attrValue = el.getAttribute(attr);
                        
                        // Handle style attribute for background images
                        if (attr === 'style' && attrValue) {
                            const bgMatch = attrValue.match(/background-image:\s*url\(['"]?([^'"]+)['"]?\)/);
                            if (bgMatch) {
                                attrValue = bgMatch[1];
                            }
                        }
                        
                        if (attrValue && attrValue.includes('cloudinary.com')) {
                            // Match Cloudinary URL patterns with better regex
                            const matches = attrValue.match(/\/([^\/\?&]+)\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv)(?:\?|$)/i);
                            if (matches && !fileName) {
                                fileName = matches[1] + '.' + matches[2];
                            }
                            
                            // Extract public ID from Cloudinary URL (improved)
                            const publicIdMatch = attrValue.match(/\/upload\/(?:v\d+\/)?([^\/\?&]+)(?:\.|$)/);
                            if (publicIdMatch && !publicId) {
                                publicId = publicIdMatch[1];
                            }
                            
                            // Detect resource type from URL
                            if (!resourceType) {
                                if (attrValue.includes('/video/upload/')) {
                                    resourceType = 'video';
                                } else if (attrValue.includes('/image/upload/')) {
                                    resourceType = 'image';
                                }
                            }
                        }
                    });
                    
                    // Extract from text content
                    if (!fileName && el.textContent) {
                        const textMatch = el.textContent.match(/([a-zA-Z0-9_-]+\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv))/i);
                        if (textMatch) {
                            fileName = textMatch[1];
                        }
                    }
                    
                    // Extract from innerHTML
                    if (!fileName) {
                        const htmlMatch = el.innerHTML.match(/([a-zA-Z0-9_-]+\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv))/gi);
                        if (htmlMatch && htmlMatch.length > 0) {
                            fileName = htmlMatch[0];
                        }
                    }
                    
                    // Enhanced file type detection with better video detection
                    function detectFileType(element, publicId, context = '') {
                        // Check element type first
                        if (element.tagName === 'VIDEO') return 'mp4';
                        
                        // Check src attributes for video URLs
                        const srcAttrs = ['src', 'data-src', 'data-original', 'data-lazy'];
                        for (let attr of srcAttrs) {
                            const src = element.getAttribute(attr);
                            if (src) {
                                // Check if URL contains video indicators
                                if (src.includes('/video/upload/') || src.includes('resource_type=video')) {
                                    return 'mp4';
                                }
                                if (src.includes('/image/upload/') || src.includes('resource_type=image')) {
                                    // Check for specific image extensions in URL
                                    if (src.includes('.png')) return 'png';
                                    if (src.includes('.gif')) return 'gif';
                                    if (src.includes('.jpeg')) return 'jpeg';
                                    return 'jpg';
                                }
                            }
                        }
                        
                        // Check data attributes for media type
                        const mediaType = element.getAttribute('data-media-type') || 
                                        element.getAttribute('data-resource-type') ||
                                        element.getAttribute('data-type');
                        if (mediaType) {
                            if (mediaType.toLowerCase().includes('video')) return 'mp4';
                            if (mediaType.toLowerCase().includes('image')) return 'jpg';
                        }
                        
                        // Check class names and attributes with better patterns
                        const classList = element.className.toLowerCase();
                        const innerHTML = element.innerHTML.toLowerCase();
                        const allAttributes = Array.from(element.attributes).map(attr => 
                            `${attr.name}="${attr.value}"`).join(' ').toLowerCase();
                        const allText = (classList + ' ' + innerHTML + ' ' + allAttributes + ' ' + context).toLowerCase();
                        
                        // More specific video indicators
                        const videoIndicators = [
                            'video', 'mp4', 'mov', 'avi', 'webm', 'mkv',
                            'play-button', 'video-player', 'video-thumbnail',
                            'resource_type=video', '/video/upload/',
                            'data-resource-type="video"', 'media-type="video"'
                        ];
                        
                        const imageIndicators = [
                            'image', 'photo', 'picture', 'img',
                            'resource_type=image', '/image/upload/',
                            'data-resource-type="image"', 'media-type="image"'
                        ];
                        
                        // Check for video indicators first (more specific)
                        for (let indicator of videoIndicators) {
                            if (allText.includes(indicator)) {
                                return 'mp4';
                            }
                        }
                        
                        // Check for specific image extensions
                        if (allText.includes('png') || allText.includes('.png')) return 'png';
                        if (allText.includes('gif') || allText.includes('.gif')) return 'gif';
                        if (allText.includes('jpeg') || allText.includes('.jpeg')) return 'jpeg';
                        
                        // Check for image indicators
                        for (let indicator of imageIndicators) {
                            if (allText.includes(indicator)) {
                                return 'jpg';
                            }
                        }
                        
                        // Check parent elements for context (up to 5 levels)
                        let parent = element.parentElement;
                        for (let i = 0; i < 5 && parent; i++) {
                            const parentClass = parent.className.toLowerCase();
                            const parentAttrs = Array.from(parent.attributes).map(attr => 
                                `${attr.name}="${attr.value}"`).join(' ').toLowerCase();
                            const parentContext = parentClass + ' ' + parentAttrs;
                            
                            // Check parent for video indicators
                            for (let indicator of videoIndicators) {
                                if (parentContext.includes(indicator)) {
                                    return 'mp4';
                                }
                            }
                            
                            parent = parent.parentElement;
                        }
                        
                        // Check if element is inside IMG tag (likely image)
                        if (element.tagName === 'IMG' || element.closest('img')) {
                            return 'jpg';
                        }
                        
                        // Default to jpg for images (most common)
                        return 'jpg';
                    }
                    
                    // Add to results with improved extension handling
                    if (fileName || publicId) {
                        let finalFileName = fileName;
                        let finalPublicId = publicId;
                        
                        // If we have filename with extension, use it
                        if (fileName && /\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv)$/i.test(fileName)) {
                            if (!fileNames.includes(fileName)) {
                                fileNames.push(fileName);
                                console.log(`✅ Found file with extension: ${fileName}`);
                            }
                        } 
                        // If we have filename without extension, add appropriate extension
                        else if (fileName) {
                            const ext = detectFileType(el, fileName, resourceType);
                            const fullName = fileName + '.' + ext;
                            if (!fileNames.includes(fullName)) {
                                fileNames.push(fullName);
                                console.log(`✅ Added extension to file: ${fullName} (detected: ${ext})`);
                            }
                        }
                        // If we only have public ID, create filename
                        else if (publicId) {
                            // Use resource type if available for better detection
                            let ext;
                            if (resourceType === 'video') {
                                ext = 'mp4';
                            } else if (resourceType === 'image') {
                                ext = 'jpg';
                            } else {
                                ext = detectFileType(el, publicId, resourceType);
                            }
                            
                            const generatedName = publicId + '.' + ext;
                            if (!fileNames.includes(generatedName)) {
                                fileNames.push(generatedName);
                                console.log(`✅ Generated filename: ${generatedName} (type: ${resourceType || 'detected'})`);
                            }
                        }
                        
                        // Track public IDs separately
                        if (publicId && !publicIds.includes(publicId)) {
                            publicIds.push(publicId);
                        }
                    }
                });
            } catch (e) {
                console.warn(`⚠️ Error with selector "${selector}":`, e);
            }
        });
        
        // Additional extraction from page source and API calls
        try {
            const pageSource = document.documentElement.innerHTML;
            
            // Extract from full Cloudinary URLs with extensions
            const urlMatches = pageSource.match(/https:\/\/res\.cloudinary\.com\/[^\/]+\/(?:image|video)\/upload\/(?:v\d+\/)?([^\/\s"']+)\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv)/gi);
            if (urlMatches) {
                urlMatches.forEach(url => {
                    const match = url.match(/\/([^\/]+\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv))$/i);
                    if (match && !fileNames.includes(match[1])) {
                        fileNames.push(match[1]);
                    }
                });
            }
            
            // Extract public IDs from Cloudinary URLs and determine type
            const publicIdMatches = pageSource.match(/https:\/\/res\.cloudinary\.com\/[^\/]+\/(image|video)\/upload\/(?:v\d+\/)?([^\/\s"',]+)/gi);
            if (publicIdMatches) {
                publicIdMatches.forEach(url => {
                    const match = url.match(/\/(image|video)\/upload\/(?:v\d+\/)?([^\/\s"',]+)/);
                    if (match) {
                        const mediaType = match[1];
                        const publicId = match[2];
                        const ext = mediaType === 'video' ? 'mp4' : 'jpg';
                        const fileName = publicId + '.' + ext;
                        
                        if (!fileNames.includes(fileName)) {
                            fileNames.push(fileName);
                        }
                    }
                });
            }
            
        } catch (e) {
            console.warn('⚠️ Error extracting from page source:', e);
        }
        
        return fileNames;
    }
    
    // Enhanced function to scroll and load more content
    function scrollAndExtract() {
        return new Promise((resolve) => {
            let allFiles = [];
            let scrollCount = 0;
            let noNewContentCount = 0;
            const maxScrolls = 100; // Increased limit
            const maxNoNewContent = 5; // Stop after 5 scrolls with no new content
            
            function doScroll() {
                // Extract current files
                const currentFiles = extractFileNames();
                const previousCount = allFiles.length;
                allFiles = [...new Set([...allFiles, ...currentFiles])];
                const newCount = allFiles.length;
                
                console.log(`📄 Scroll ${scrollCount + 1}: Found ${currentFiles.length} files on page (Total unique: ${newCount})`);
                
                // Check if we found new content
                if (newCount === previousCount) {
                    noNewContentCount++;
                    console.log(`⏳ No new content found (${noNewContentCount}/${maxNoNewContent})`);
                } else {
                    noNewContentCount = 0; // Reset counter
                    console.log(`✨ Found ${newCount - previousCount} new files!`);
                }
                
                // Try different scroll methods optimized for Cloudinary mosaic view
                const scrollMethods = [
                    // Method 1: Scroll main window
                    () => window.scrollTo(0, document.body.scrollHeight),
                    
                    // Method 2: Scroll by viewport height
                    () => window.scrollBy(0, window.innerHeight * 2),
                    
                    // Method 3: Find and scroll Cloudinary containers
                    () => {
                        const containers = [
                            document.querySelector('[class*="MediaLibrary"]'),
                            document.querySelector('[class*="media-library"]'),
                            document.querySelector('[class*="asset-grid"]'),
                            document.querySelector('[class*="mosaic"]'),
                            document.querySelector('[class*="grid-container"]'),
                            document.querySelector('[class*="scroll"]'),
                            document.querySelector('[class*="container"]'),
                            document.querySelector('main'),
                            document.querySelector('.main-content'),
                            document.querySelector('#main')
                        ].filter(Boolean);
                        
                        containers.forEach(container => {
                            if (container) {
                                container.scrollTop = container.scrollHeight;
                                container.scrollBy(0, container.clientHeight);
                            }
                        });
                    },
                    
                    // Method 4: Scroll to last visible asset
                    () => {
                        const assets = document.querySelectorAll('[data-testid="media-library-asset"], .asset-card, .media-item');
                        if (assets.length > 0) {
                            const lastAsset = assets[assets.length - 1];
                            lastAsset.scrollIntoView({ behavior: 'smooth', block: 'end' });
                        }
                    }
                ];
                
                // Use different scroll method each time
                const scrollMethod = scrollMethods[scrollCount % scrollMethods.length];
                scrollMethod();
                scrollCount++;
                
                // Enhanced lazy loading trigger for Cloudinary
                try {
                    // Trigger multiple events to ensure lazy loading
                    const events = ['scroll', 'resize', 'load', 'DOMContentLoaded'];
                    events.forEach(eventType => {
                        const event = new Event(eventType, { bubbles: true });
                        window.dispatchEvent(event);
                        document.dispatchEvent(event);
                    });
                    
                    // Trigger intersection observer for lazy loading
                    const assets = document.querySelectorAll('[data-testid="media-library-asset"], .asset-card, .media-item');
                    assets.forEach(asset => {
                        // Simulate mouse over to trigger loading
                        const mouseEvent = new MouseEvent('mouseover', { bubbles: true });
                        asset.dispatchEvent(mouseEvent);
                        
                        // Focus on element to trigger loading
                        if (asset.focus) {
                            asset.focus();
                        }
                    });
                    
                    // Click on "Load More" buttons if they exist
                    const loadMoreButtons = document.querySelectorAll('[class*="load-more"], [class*="show-more"], button[class*="more"]');
                    loadMoreButtons.forEach(button => {
                        if (button.textContent.toLowerCase().includes('more') || 
                            button.textContent.toLowerCase().includes('load')) {
                            console.log('🔄 Clicking load more button:', button.textContent);
                            button.click();
                        }
                    });
                    
                } catch (e) {
                    console.warn('⚠️ Could not trigger lazy loading events:', e);
                }
                
                // Wait longer for content to load
                const waitTime = scrollCount < 10 ? 3000 : 2000; // Wait longer for first few scrolls
                
                setTimeout(() => {
                    // Check if we should continue
                    const shouldContinue = scrollCount < maxScrolls && noNewContentCount < maxNoNewContent;
                    
                    if (shouldContinue) {
                        doScroll();
                    } else {
                        const reason = scrollCount >= maxScrolls ? 'Max scrolls reached' : 'No new content found';
                        console.log(`✅ Extraction complete! Reason: ${reason}`);
                        console.log(`📊 Final count: ${allFiles.length} files`);
                        resolve(allFiles);
                    }
                }, waitTime);
            }
            
            // Initial extraction before scrolling
            console.log('🔍 Starting initial extraction...');
            doScroll();
        });
    }
    
    // Start extraction
    scrollAndExtract().then(files => {
        if (files.length === 0) {
            console.log('❌ No files found. Make sure you are in Cloudinary Media Library.');
            alert('No files found. Make sure you are in Cloudinary Media Library and try again.');
            return;
        }
        
        // Create downloadable file list
        const fileList = files.join('\n');
        const blob = new Blob([fileList], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        
        // Create download link
        const a = document.createElement('a');
        a.href = url;
        a.download = 'cloudinary-files.txt';
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        // Also copy to clipboard
        navigator.clipboard.writeText(fileList).then(() => {
            console.log('📋 File list copied to clipboard!');
        });
        
        // Show results
        console.log('📁 Extracted Files:');
        files.forEach((file, index) => {
            console.log(`${index + 1}. ${file}`);
        });
        
        alert(`🎉 Extraction Complete! 
        
📊 Found ${files.length} files out of 105 expected
✅ Downloaded as 'cloudinary-files.txt'
✅ Copied to clipboard

📋 File breakdown:
${files.filter(f => f.endsWith('.jpg') || f.endsWith('.jpeg') || f.endsWith('.png')).length} images
${files.filter(f => f.endsWith('.mp4') || f.endsWith('.mov') || f.endsWith('.avi')).length} videos

Next steps:
1. Check the downloaded file
2. If missing files, try scrolling manually first
3. Run script again for better results
4. Use URL Generator to import files`);
        
        // Enhanced debug info for troubleshooting
        console.log('🔍 Debug Info:');
        console.log('- Page URL:', window.location.href);
        console.log('- Page title:', document.title);
        console.log('- Total DOM elements:', document.querySelectorAll('*').length);
        console.log('- Images found:', document.querySelectorAll('img').length);
        console.log('- Videos found:', document.querySelectorAll('video').length);
        console.log('- Cloudinary images:', document.querySelectorAll('img[src*="cloudinary.com"]').length);
        console.log('- Cloudinary videos:', document.querySelectorAll('video[src*="cloudinary.com"]').length);
        console.log('- Assets with data-public-id:', document.querySelectorAll('[data-public-id]').length);
        console.log('- Assets with data-testid:', document.querySelectorAll('[data-testid*="asset"]').length);
        console.log('- Media library assets:', document.querySelectorAll('[data-testid="media-library-asset"]').length);
        console.log('- Asset cards:', document.querySelectorAll('.asset-card, [class*="AssetCard"]').length);
        
        // Show file type breakdown
        const imageFiles = files.filter(f => /\.(jpg|jpeg|png|gif)$/i.test(f));
        const videoFiles = files.filter(f => /\.(mp4|avi|mov|webm|mkv)$/i.test(f));
        console.log('📊 File Type Breakdown:');
        console.log(`- Images: ${imageFiles.length} files`);
        console.log(`- Videos: ${videoFiles.length} files`);
        
        if (imageFiles.length > 0) {
            console.log('📷 Image files found:', imageFiles.slice(0, 5).join(', ') + (imageFiles.length > 5 ? '...' : ''));
        }
        if (videoFiles.length > 0) {
            console.log('🎬 Video files found:', videoFiles.slice(0, 5).join(', ') + (videoFiles.length > 5 ? '...' : ''));
        }
    });
})();

// Enhanced manual extraction function with mosaic view support
window.manualExtract = function(addExtensions = true) {
    console.log('🔧 Enhanced manual extraction started...');
    
    // First, try to detect current view type
    const isMosaicView = document.querySelector('[class*="mosaic"]') || 
                        document.querySelector('[class*="grid"]') ||
                        document.querySelector('[data-testid*="grid"]');
    
    console.log(`📋 Detected view type: ${isMosaicView ? 'Mosaic/Grid' : 'List'}`);
    
    const files = extractFileNames();
    console.log(`Found ${files.length} files manually`);
    
    // Additional extraction methods for mosaic view
    if (isMosaicView && files.length < 20) {
        console.log('🔍 Trying additional extraction methods for mosaic view...');
        
        // Method 1: Extract from all Cloudinary URLs in page source
        const pageHTML = document.documentElement.outerHTML;
        const cloudinaryUrls = pageHTML.match(/https:\/\/res\.cloudinary\.com\/[^"'\s]+/g) || [];
        
        cloudinaryUrls.forEach(url => {
            const match = url.match(/\/upload\/(?:v\d+\/)?([^\/\?&]+)(?:\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv))?/i);
            if (match) {
                const publicId = match[1];
                let ext = match[2];
                
                if (!ext) {
                    // Determine extension from URL path
                    if (url.includes('/video/upload/')) {
                        ext = 'mp4';
                    } else if (url.includes('/image/upload/')) {
                        ext = 'jpg';
                    } else {
                        ext = 'jpg'; // default
                    }
                }
                
                const fileName = publicId + '.' + ext;
                if (!files.includes(fileName)) {
                    files.push(fileName);
                    console.log(`➕ Added from URL: ${fileName}`);
                }
            }
        });
        
        // Method 2: Extract from JavaScript variables
        try {
            const scripts = document.querySelectorAll('script');
            scripts.forEach(script => {
                if (script.textContent.includes('public_id') || script.textContent.includes('cloudinary')) {
                    const publicIdMatches = script.textContent.match(/"public_id":\s*"([^"]+)"/g) || [];
                    publicIdMatches.forEach(match => {
                        const publicId = match.match(/"public_id":\s*"([^"]+)"/)[1];
                        const fileName = publicId + '.jpg'; // default to jpg
                        if (!files.includes(fileName)) {
                            files.push(fileName);
                            console.log(`➕ Added from script: ${fileName}`);
                        }
                    });
                }
            });
        } catch (e) {
            console.warn('⚠️ Could not extract from scripts:', e);
        }
    }
    
    if (files.length > 0) {
        let processedFiles = files;
        
        // Option to remove extensions if user wants raw public IDs
        if (!addExtensions) {
            processedFiles = files.map(file => {
                return file.replace(/\.(jpg|jpeg|png|gif|mp4|avi|mov|webm|mkv)$/i, '');
            });
        }
        
        const fileList = processedFiles.join('\n');
        const blob = new Blob([fileList], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        
        const a = document.createElement('a');
        a.href = url;
        a.download = addExtensions ? 'cloudinary-files-manual.txt' : 'cloudinary-public-ids.txt';
        a.click();
        URL.revokeObjectURL(url);
        
        navigator.clipboard.writeText(fileList);
        
        // Show detailed results
        const imageCount = files.filter(f => /\.(jpg|jpeg|png|gif)$/i.test(f)).length;
        const videoCount = files.filter(f => /\.(mp4|avi|mov|webm|mkv)$/i.test(f)).length;
        
        alert(`🎉 Manual extraction complete!
        
📊 Results: ${files.length} files found
📷 Images: ${imageCount}
🎬 Videos: ${videoCount}
        
${addExtensions ? '✅ With extensions' : '✅ Public IDs only'}
📋 Copied to clipboard
💾 Downloaded as file

If you expected more files (like 41), try:
1. Scroll down to load all assets first
2. Switch to List view if in Mosaic
3. Run the automatic extraction instead`);
    } else {
        alert(`❌ No files found in manual extraction.

🔧 Troubleshooting:
1. Make sure you're in Cloudinary Media Library
2. Try scrolling down to load more assets
3. Switch between Grid/List views
4. Refresh page and try again
5. Check browser console for errors`);
    }
};

// Extract only public IDs without extensions
window.extractPublicIds = function() {
    return manualExtract(false);
};

console.log(`
🎯 ENHANCED CLOUDINARY EXTRACTOR v2.0 - MOSAIC VIEW OPTIMIZED

📋 QUICK START:
1. Open Cloudinary Media Library
2. Navigate to your folder (you mentioned 41 assets)
3. Paste this script in console (F12)
4. Wait for automatic extraction

🔧 FOR MOSAIC VIEW (your case):
- Script now optimized for mosaic/grid layout
- Better video detection (fixes jpg misclassification)
- Enhanced lazy loading triggers
- Improved asset counting

📊 IF YOU GET LESS THAN 41 FILES:
1. Scroll down manually first to load ALL assets
2. Wait for all thumbnails to appear
3. Run: manualExtract() in console
4. Try switching to List view temporarily
5. Refresh and run script again

🎬 VIDEO DETECTION FIXES:
- Now checks data-resource-type="video"
- Looks for /video/upload/ in URLs
- Better parent element analysis
- Prevents videos being marked as .jpg

🚀 COMMANDS AVAILABLE:
- manualExtract() - Enhanced manual extraction
- extractPublicIds() - Get public IDs without extensions
- window.extractFileNames() - Debug current page

⚡ TROUBLESHOOTING 18/41 ISSUE:
1. Make sure ALL assets are loaded (scroll to bottom)
2. Check if some assets are in subfolders
3. Verify you're in the correct folder
4. Try List view instead of Mosaic
5. Some assets might be in different resource types

💡 The script now shows detailed logs - check console for:
- "✅ Found file with extension"
- "✅ Generated filename" 
- File type breakdown (images vs videos)
`);