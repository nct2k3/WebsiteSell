<!DOCTYPE html>
<html>
<head>
  <title>Đơn hàng của bạn</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class=" bg-gray-900 h-16 pt-1"></div>
  <div class="container mx-auto">
    <h1 class="text-3xl font-bold text-center">Your cart</h1>

    <div class="bg-white shadow-md rounded px-10 pt-6 pb-8 my-4 mx-20">
      <table class="w-full">
        <thead>
          <tr>
            <th class="text-left">Sản phẩm</th>
            <th class="text-left">Anh</th>
            <th class="text-left">Giá</th>
            <th class="text-left">Số lượng</th>
            <th class="text-right">Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="py-2 px-1">Laptop HP 15 fd0234TU i5 (Màu Vàng)</td>
            <td class="py-2 px-1 "><img class="h-12" src="https://cdn.tgdd.vn/Products/Images/42/329143/s16/iphone-16-pro-tu-nhien-650x650.png"> </td>
            <td class="py-2 px-1">15.990.000₫</td>
            <td class="flex mt-3">
                <a class="py-2 px-1">+</a>
                <a class="py-2 px-1">2</a>   
                <a class="py-2 px-1">-</a>
            </td>
            
            <td class="py-2 px-1 text-right">31.980.000₫</td>
          </tr>
          <tr>
            <td class="py-2 px-1">Điện thoại iPhone 16 Pro Max 256GB (Màu Titan Sa Mạc)</td>
            <td class="py-2 px-1 "><img class="h-12" src="https://cdn.tgdd.vn/Products/Images/42/329143/s16/iphone-16-pro-tu-nhien-650x650.png"> </td>
            <td class="py-2 px-1">32.890.000₫</td>
            <td class="flex mt-3">
                <a class="py-2 px-1">+</a>
                <a class="py-2 px-1">2</a>   
                <a class="py-2 px-1">-</a>
            </td>
            <td class="py-2 px-1 text-right">32.890.000₫</td>
          </tr>
        </tbody>
      </table>

      <p class="text-right"><strong>Tổng tiền:</strong> 48.880.000₫</p>
    </div>
  </div>
</body>
</html>