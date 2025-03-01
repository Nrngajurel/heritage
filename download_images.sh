#!/bin/bash

# Function to download and verify image
download_image() {
    local url="$1"
    local output="$2"
    
    # Create directory if it doesn't exist
    mkdir -p "$(dirname "$output")"
    
    # Download image with proper headers
    curl -L -H "User-Agent: Mozilla/5.0" --fail --silent --output "$output" "$url"
    
    # Verify if it's a valid image
    if file "$output" | grep -qiE "image|JPEG|PNG|GIF"; then
        echo "Successfully downloaded: $output"
    else
        echo "Failed to download valid image: $output"
        rm -f "$output"
        return 1
    fi
}

# Base directory
BASE_DIR="public/images"

# Specific image URLs (using pexels.com free stock photos)
IMAGES=(
    "slider/slide1.jpg|https://images.pexels.com/photos/7681118/pexels-photo-7681118.jpeg"
    "slider/slide2.jpg|https://images.pexels.com/photos/7681091/pexels-photo-7681091.jpeg"
    "about/about-heritage.jpg|https://images.pexels.com/photos/7681105/pexels-photo-7681105.jpeg"
    "title-holders/holder1.jpg|https://images.pexels.com/photos/7681097/pexels-photo-7681097.jpeg"
    "title-holders/holder2.jpg|https://images.pexels.com/photos/7681101/pexels-photo-7681101.jpeg"
    "title-holders/holder3.jpg|https://images.pexels.com/photos/7681089/pexels-photo-7681089.jpeg"
    "title-holders/holder4.jpg|https://images.pexels.com/photos/7681093/pexels-photo-7681093.jpeg"
    "gallery/gallery1.jpg|https://images.pexels.com/photos/7681095/pexels-photo-7681095.jpeg"
    "gallery/gallery2.jpg|https://images.pexels.com/photos/7681099/pexels-photo-7681099.jpeg"
    "gallery/gallery3.jpg|https://images.pexels.com/photos/7681103/pexels-photo-7681103.jpeg"
    "gallery/gallery4.jpg|https://images.pexels.com/photos/7681107/pexels-photo-7681107.jpeg"
    "gallery/gallery5.jpg|https://images.pexels.com/photos/7681111/pexels-photo-7681111.jpeg"
    "gallery/gallery6.jpg|https://images.pexels.com/photos/7681115/pexels-photo-7681115.jpeg"
    "gallery/gallery7.jpg|https://images.pexels.com/photos/7681119/pexels-photo-7681119.jpeg"
    "gallery/gallery8.jpg|https://images.pexels.com/photos/7681123/pexels-photo-7681123.jpeg"
    "news/news1.jpg|https://images.pexels.com/photos/7681127/pexels-photo-7681127.jpeg"
    "news/news2.jpg|https://images.pexels.com/photos/7681131/pexels-photo-7681131.jpeg"
    "news/news3.jpg|https://images.pexels.com/photos/7681135/pexels-photo-7681135.jpeg"
)

# Create base directory
mkdir -p "$BASE_DIR"

# Download each image
for image in "${IMAGES[@]}"; do
    IFS="|" read -r path url <<< "$image"
    output_path="$BASE_DIR/$path"
    echo "Downloading $url to $output_path"
    download_image "$url" "$output_path"
done

echo "Image download process completed. Please check the images in $BASE_DIR"
