<?php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biểu mẫu đăng ký</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script>
    function validatePassword() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("ConfirmPassword").value;
      const errorDiv = document.getElementById("error-message");

      if (password !== confirmPassword) {
        errorDiv.textContent = "Mật khẩu xác nhận không khớp!";
        errorDiv.classList.remove("hidden");
        return false;
      } else {
        errorDiv.textContent = "";
        errorDiv.classList.add("hidden");
      }
      return true;
    }

    function loadDistricts() {
      const provinceCode = document.getElementById("ProvinceCode").value;
      const districtSelect = document.getElementById("DistrictCode");

      districtSelect.innerHTML = '<option value="">Chọn huyện</option>';

      if (provinceCode) {
        fetch(`?controller=Adduser&action=getDistricts&province=${provinceCode}`)
          .then(response => response.json())
          .then(data => {
            data.forEach(district => {
              const option = document.createElement("option");
              option.value = district.code;
              option.textContent = district.name;
              option.classList.add("bg-gray-800", "text-gray-200");
              districtSelect.appendChild(option);
            });
          })
          .catch(error => console.error('Error loading districts:', error));
      }
    }
  </script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #111827;
      background-image: 
        radial-gradient(circle at 25% 25%, rgba(74, 85, 104, 0.05) 0%, transparent 40%),
        radial-gradient(circle at 75% 75%, rgba(79, 70, 229, 0.05) 0%, transparent 40%);
    }
    
    /* Loại bỏ outline khi focus */
    input:focus, select:focus, button:focus {
      outline: none;
    }
    
    /* Tùy chỉnh select */
    select {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23A78BFA' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.75rem center;
      background-size: 1em;
      padding-right: 2.5rem;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }
    
    /* Input number - hide arrows */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
    }
    
    input[type=number] {
      -moz-appearance: textfield;
    }
    
    /* Thanh cuộn tối */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #1F2937;
    }
    ::-webkit-scrollbar-thumb {
      background: #4B5563;
      border-radius: 4px;
    }
    
    /* Input styling */
    .input-field {
      transition: all 0.3s;
      background-color: rgba(55, 65, 81, 0.8);
    }
    
    .input-field:focus-within {
      background-color: rgba(55, 65, 81, 1);
      box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
    }
    
    /* Button glow effect */
    .btn-glow {
      position: relative;
      z-index: 1;
      overflow: hidden;
      transition: all 0.3s;
    }
    
    .btn-glow:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 0;
      background: linear-gradient(to top, rgba(129, 140, 248, 0.2), transparent);
      z-index: -1;
      transition: height 0.3s ease-out;
    }
    
    .btn-glow:hover:after {
      height: 100%;
    }
    
    /* Form background effect */
    .card-bg {
      position: relative;
      overflow: hidden;
    }
    
    .card-bg:before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at center, rgba(99, 102, 241, 0.03) 0%, transparent 70%);
      transform: rotate(0deg);
      z-index: 0;
    }
  </style>
</head>

<body class="text-gray-200 min-h-screen py-8">
  <div class="flex justify-center min-h-screen items-center">
    <div class="w-full max-w-5xl animate__animated animate__fadeIn">
      <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-2xl overflow-hidden shadow-2xl card-bg">
        <div class="w-full px-8 py-10 relative z-10">
          <h2 class="text-4xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Tạo tài khoản mới</h2>
          <p class="text-gray-400 text-center mb-8">Đăng ký để trải nghiệm dịch vụ của chúng tôi</p>
          
          <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-500 bg-opacity-80 text-white text-center p-4 mb-6 rounded-lg shadow-lg animate__animated animate__headShake">
              <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>
          
          <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-500 bg-opacity-80 text-white text-center p-4 mb-6 rounded-lg shadow-lg animate__animated animate__fadeIn">
              <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
          <?php endif; ?>
          
          <form action="?controller=Adduser" method="POST" class="space-y-6" onsubmit="return validatePassword();">
            <input type="hidden" name="action" value="Adduser">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
              <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-indigo-300">Địa chỉ email</label>
                <div class="input-field rounded-lg p-3 flex items-center">
                  <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                  <input type="email" name="Email" id="email" 
                      class="w-full bg-transparent text-indigo-200" 
                      placeholder="Nhập email của bạn" required>
                </div>
              </div>
              
              <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-indigo-300">Mật khẩu</label>
                <div class="input-field rounded-lg p-3 flex items-center">
                  <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                  </svg>
                  <input type="password" name="Password" id="password" 
                      class="w-full bg-transparent text-indigo-200" 
                      placeholder="Nhập mật khẩu của bạn" required>
                </div>
              </div>
              
              <div class="space-y-2">
                <label for="ConfirmPassword" class="block text-sm font-medium text-indigo-300">Xác nhận mật khẩu</label>
                <div class="input-field rounded-lg p-3 flex items-center">
                  <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                  </svg>
                  <input type="password" name="ConfirmPassword" id="ConfirmPassword" 
                      class="w-full bg-transparent text-indigo-200" 
                      placeholder="Nhập lại mật khẩu của bạn" required>
                </div>
              </div>
              
              <div class="space-y-2">
                <label for="FullName" class="block text-sm font-medium text-indigo-300">Họ và tên</label>
                <div class="input-field rounded-lg p-3 flex items-center">
                  <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  <input type="text" name="FullName" id="FullName" 
                      class="w-full bg-transparent text-indigo-200" 
                      placeholder="Nhập họ và tên của bạn" required>
                </div>
              </div>
              
              <div class="space-y-2">
                <label for="NumberPhone" class="block text-sm font-medium text-indigo-300">Số điện thoại</label>
                <div class="input-field rounded-lg p-3 flex items-center">
                  <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                  <input type="number" name="NumberPhone" id="NumberPhone" 
                      class="w-full bg-transparent text-indigo-200" 
                      placeholder="Nhập số điện thoại của bạn" required>
                </div>
              </div>
              
              <div class="space-y-2">
                <label for="ProvinceCode" class="block text-sm font-medium text-indigo-300">Tỉnh/Thành phố</label>
                <div class="input-field rounded-lg p-3">
                  <select name="ProvinceCode" id="ProvinceCode" 
                      class="w-full bg-transparent text-indigo-200" 
                      required onchange="loadDistricts()">
                      <option value="" class="bg-gray-800 text-gray-200">Chọn tỉnh/thành phố</option>
                      <?php foreach ($provinces as $province): ?>
                          <option value="<?= $province->code ?>" class="bg-gray-800 text-gray-200"><?= $province->name ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>
              
              <div class="space-y-2">
                <label for="DistrictCode" class="block text-sm font-medium text-indigo-300">Quận/Huyện</label>
                <div class="input-field rounded-lg p-3">
                  <select name="DistrictCode" id="DistrictCode" 
                      class="w-full bg-transparent text-indigo-200" 
                      required>
                      <option value="" class="bg-gray-800 text-gray-200">Chọn huyện</option>
                  </select>
                </div>
              </div>
              
              <div class="space-y-2 md:col-span-2">
                <label for="SpecificAddress" class="block text-sm font-medium text-indigo-300">Địa chỉ cụ thể</label>
                <div class="input-field rounded-lg p-3 flex items-center">
                  <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <input type="text" name="SpecificAddress" id="SpecificAddress" 
                      class="w-full bg-transparent text-indigo-200" 
                      placeholder="Nhập địa chỉ cụ thể của bạn" required>
                </div>
              </div>
            </div>
            
            <div id="error-message" class="text-red-500 text-sm hidden mb-4 text-center"></div>
            
            <div class="pt-4">
              <button type="submit" 
                class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg font-semibold text-lg transition duration-300 btn-glow">
                Đăng ký tài khoản
              </button>
            </div>
            
            <div class="text-center text-gray-400 text-sm">
              Đã có tài khoản? <a href="?controller=Login" class="text-indigo-400 hover:text-indigo-300 transition-colors">Đăng nhập ngay</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>