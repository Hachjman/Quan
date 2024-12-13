// Khi chuột di qua phần tử .dropdown, hiển thị menu thả xuống
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
 // Lấy các phần tử cần thiết
const dropdowns = document.querySelectorAll('.dropdown-content a');
window.location.href = 'edit.php';
// Thêm sự kiện click cho từng liên kết
dropdowns.forEach(dropdown => {
    dropdown.addEventListener('click', (event) => {
        const href = event.target.href;
        // Kiểm tra href để thực hiện chuyển hướng
        if (href === '#') {
            // Nếu href là '#', nghĩa là chưa có đường dẫn cụ thể, bạn có thể:
            // 1. Ngăn chặn hành vi mặc định của liên kết
            event.preventDefault();
            // 2. Thực hiện các hành động khác, ví dụ:
            if (dropdown.textContent === 'Cá nhân') {
                window.location.href = 'home.php'; // Thay thế bằng đường dẫn đúng
            } else if (dropdown.textContent === 'Đăng xuất') {
                window.location.href = 'index1.php'; // Thay thế bằng đường dẫn đúng
            }
        }
    });
});

// ...
if (dropdown.dataset.action === 'ca-nhan') {
  window.location.href = 'home.php';
} else if (dropdown.dataset.action === 'dang-xuat') {
  // ...
}

function captureImage() {
  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const context = canvas.getContext('2d');   


  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;

  context.drawImage(video, 0, 0, canvas.width, canvas.height);

  const capturedImage = canvas.toDataURL('image/jpeg');   

  localStorage.setItem('capturedImage', capturedImage);

  // Display the captured image
  document.getElementById('capturedImage').src = capturedImage;
}
function captureImage() {
  // ... (Mã code hiện tại của bạn)

  // Kiểm tra xem ảnh đã được chụp thành công chưa
  if (capturedImage) {
    localStorage.setItem('capturedImage', capturedImage);
    document.getElementById('capturedImage').src = capturedImage;
  } else {
    console.error('Lỗi khi chụp ảnh');
  }
}