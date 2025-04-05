<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chân Trang</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom styles for enhanced visuals */
    .footer-section h3 {
      position: relative;
      display: inline-block;
      padding-bottom: 8px;
    }
    .footer-section h3::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50%;
      height: 2px;
      background: linear-gradient(to right, #ec4899, transparent);
    }
    .footer-link {
      transition: transform 0.3s ease, color 0.3s ease;
    }
    .footer-link:hover {
      transform: translateX(5px);
    }
    .social-icon {
      transition: transform 0.3s ease, color 0.3s ease;
    }
    .social-icon:hover {
      transform: scale(1.2);
    }
    /* Ensure phone number and time stay on the same line */
    .contact-info {
      display: flex;
      flex-wrap: nowrap;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
    }
  </style>
</head>
<body class="bg-gray-900 text-white font-sans">

  <!-- Top Section -->
  <div class="bg-gradient-to-r from-gray-800 to-gray-700 py-10">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <div class="transform hover:scale-105 transition-transform duration-300">
        <div class="text-4xl mb-3 text-green-400">✔️</div>
        <p class="font-medium text-sm leading-relaxed text-white">Đa dạng mẫu mã, sản phẩm chính hãng</p>
      </div>
      <div class="transform hover:scale-105 transition-transform duration-300">
        <div class="text-4xl mb-3 text-blue-400">🚚</div>
        <p class="font-medium text-sm leading-relaxed text-white">Giao hàng toàn quốc</p>
      </div>
      <div class="transform hover:scale-105 transition-transform duration-300">
        <div class="text-4xl mb-3 text-yellow-400">🛡️</div>
        <p class="font-medium text-sm leading-relaxed text-white">Cam kết bảo hành lên đến 12 tháng</p>
      </div>
      <div class="transform hover:scale-105 transition-transform duration-300">
        <div class="text-4xl mb-3 text-purple-400">🔄</div>
        <p class="font-medium text-sm leading-relaxed text-white">Đổi trả với chúng tôi</p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-gradient-to-b from-gray-900 to-black py-12 text-white">
    <div class="max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        <!-- Logo and Contact -->
        <div class="space-y-4">
          <h2 class="text-xl font-bold tracking-tight">
            Cửa hàng <span class="text-pink-500 font-extrabold">iPhone hàng đầu</span>
          </h2>
          <p class="contact-info hover:text-pink-400 transition-colors text-sm">
            <span class="text-pink-400">📞</span> 
            <span>Bán hàng:</span> 
            <strong>+84 368 731 585</strong>
            <span class="text-xs text-gray-400">(8:00 - 21:30)</span>
          </p>
          <p class="contact-info hover:text-pink-400 transition-colors text-sm">
            <span class="text-pink-400">📞</span> 
            <span>Khiếu nại:</span> 
            <strong>+84 368 731 585</strong>
            <span class="text-xs text-gray-400">(8:00 - 21:30)</span>
          </p>
          <div class="flex space-x-4 mt-4">
            <a href="#" class="text-2xl social-icon hover:text-blue-400">🌐</a>
            <a href="#" class="text-2xl social-icon hover:text-red-400">📺</a>
            <a href="#" class="text-2xl social-icon hover:text-green-400">💬</a>
          </div>
        </div>

        <!-- Store Info -->
        <div class="footer-section">
          <h3 class="text-base font-bold mb-4 text-pink-400">Hệ Thống Cửa Hàng</h3>
          <ul class="space-y-3">
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Xem 86 cửa hàng</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Quy định cửa hàng</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Chất lượng dịch vụ</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Chính sách bảo hành & đổi trả</a></li>
          </ul>
        </div>

        <!-- Customer Support -->
        <div class="footer-section">
          <h3 class="text-base font-bold mb-4 text-pink-400">Hỗ Trợ Khách Hàng</h3>
          <ul class="space-y-3">
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Điều kiện giao dịch chung</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Hướng dẫn mua hàng online</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Chính sách vận chuyển</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Hướng dẫn thanh toán</a></li>
          </ul>
        </div>

        <!-- About iPhone Store -->
        <div class="footer-section">
          <h3 class="text-base font-bold mb-4 text-pink-400">Về Cửa Hàng iPhone</h3>
          <ul class="space-y-3">
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Điểm Thưởng VIP</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Giới thiệu cửa hàng</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Bán hàng doanh nghiệp</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Chính sách bảo mật</a></li>
            <li><a href="#" class="footer-link text-sm text-gray-300 hover:text-pink-500 flex items-center gap-1">→ Phiên bản di động</a></li>
          </ul>
        </div>
      </div>
      <!-- Footer Bottom -->
      <div class="mt-10 pt-6 border-t border-gray-700 text-center text-sm text-gray-400">
        <p>© 2025 Cửa hàng iPhone hàng đầu. All rights reserved.</p>
      </div>
    </div>
  </footer>

</body>
</html>