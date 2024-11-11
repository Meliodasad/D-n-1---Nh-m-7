// slide.js

let currentIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

// Hàm chuyển sang ảnh tiếp theo
function nextSlide() {
    // Ẩn ảnh hiện tại
    slides[currentIndex].classList.remove('slide-active');
    
    // Tính toán chỉ số ảnh tiếp theo
    currentIndex = (currentIndex + 1) % totalSlides;
    
    // Hiển thị ảnh tiếp theo
    slides[currentIndex].classList.add('slide-active');
}

// Khởi tạo slideshow
function startSlideShow() {
    // Đảm bảo ảnh đầu tiên có lớp slide-active khi bắt đầu
    slides[currentIndex].classList.add('slide-active');
    
    setInterval(nextSlide, 3000);  // Mỗi 3 giây chuyển slide
}

// Khởi động slideshow khi tài liệu đã sẵn sàng
document.addEventListener('DOMContentLoaded', startSlideShow);
