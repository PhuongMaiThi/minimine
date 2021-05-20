<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::pluck('id')->toArray();
        
        $listProductNames = [
            'Chậu cây lưỡi hổ',
            'Chậu sứ trắng size 20x30cm',
            'Tiểu cảnh sen đá',
            'Tiểu cảnh xương rồng',
            'Cây kim tiền văn phòng',
            'Cây thanh xuân',
            'Thanh Lam size đại',
            'Giỏ cói handmade',
            'Chậu cosi',
            'Tượng nhà gỗ',
            'Tượng nấm',
            'Cây Mai Đá size đại',
        ];

        $listProductDescriptions = [
            'Cây lưỡi hỗ là một trong những cây phong thủy mang đến may mắn và tài lộc. Vì vậy mà nó rất được ưa chuộng để làm cây văn phòng. ',
            'Chậu được làm từ chất liệu sứ tráng men trắng. Kích thước đường kính 20cm và chiều cao 30cm.',
            'Mang đến không gian mới lạ cho bàn làm việc của bạn bằng một chậu tiểu cảnh sen đá hấp dẫn. Với đủ các loại sen đá kết hợp với phụ kiện mang đến cái nhìn mới lạ nhất.',
            'Mang đến không gian mới lạ cho bàn làm việc của bạn bằng một chậu tiểu cảnh sương rồng hấp dẫn. Với đủ các loại sương rồng kết hợp với phụ kiện mang đến cái nhìn mới lạ nhất.',
            'Cây Kim Tiền là loài cây mang đến nhiều tài lộc và tiền của cho gia chủ. Một chậu cây kim tiền văn phòng sẽ là lựa chọn tối ưu nhất cho bạn.',
            'Cây Thanh Xuân mang vẻ đẹp đặc biệt và chỉ những ai yêu mến loại cây này mới thấy được sự đặc biệt. Cây Thanh Xuân văn phòng size vừa với chiều cao từ 20-30cm.',
            'Cây Thanh Lam mang vẻ đẹp đặc biệt và chỉ những ai yêu mến loại cây này mới thấy được sự đặc biệt. Cây Thanh Lam size đại có chiều cao từ 50-70cm.',
            'Là sự kết hợp độc đáo giữa tinh tế và mộc mạc. Những chiếc giỏ cói sẽ mang đến một không gian vintage nhẹ nhàng.',
            'Chậu được làm từ đất sét Nhật và tráng qua một lớp men sứ dày. Chậu có đường kính 8cm và chiều cao 6.5cm.',
            'Tượng được làm từ đất sét Nhật có kích thước từ 3-5cm',
            'Tượng được làm từ đất sét Nhật có kích thước từ 3-5cm',
            'Cây Mai Đá size đại có kích thước siêu lớn với chiều cao từ 1-1.5m',
        ];

        $listThumbnails = [
            'https://vnn-imgs-f.vgcloud.vn/2018/05/11/14/trong-ngay-cay-luoi-ho-trong-nha-de-hap-thu-107-loai-doc-to-duoi-xui-xeo-hut-tai-loc.jpg',
            'https://luckygarden.com.vn/wp-content/uploads/2019/06/Chau-Gom-Su-Vuong-Vat-To-Mau-Trang.jpg',
            'https://caycanhhanoi.vn/wp-content/uploads/chau-tieu-canh-sen-da.jpg',
            'https://www.vuonsenda.com/uploads/products/153260666737784096_657316234648979_2633385684882161664_n.jpg',
            'https://phuongrosa.com/file/entry/2020/04/1586366581-10624.jpg',
            'https://quangcanhxanh.vn/wp-content/uploads/2019/08/TBTX5.jpg',
            'https://media3.scdn.vn/img4/2020/09_26/7xPYESLYHrzn97fGBzPL_simg_de2fe0_500x500_maxb.jpg',
            'https://cf.shopee.vn/file/8a44beaf263d9c3f5ad466b09fea0059',
            'https://bizweb.dktcdn.net/100/275/164/products/img-1830-2.jpg?v=1582343188000',
            'https://cf.shopee.vn/file/105373b44fef067d4f3a14273a6e1de5',
            'https://mohinhliti.com/wp-content/uploads/2019/07/mo-hinh-nam-lun-trang-tri-ngoai-canh-438x400.jpg',
            'https://moitruong.net.vn/wp-content/uploads/2018/02/hm3-e1518231282703.jpg',
        ];

        $listImages = [
            'https://vnn-imgs-f.vgcloud.vn/2018/05/11/14/trong-ngay-cay-luoi-ho-trong-nha-de-hap-thu-107-loai-doc-to-duoi-xui-xeo-hut-tai-loc.jpg',
            'https://luckygarden.com.vn/wp-content/uploads/2019/06/Chau-Gom-Su-Vuong-Vat-To-Mau-Trang.jpg',
            'https://caycanhhanoi.vn/wp-content/uploads/chau-tieu-canh-sen-da.jpg',
            'https://www.vuonsenda.com/uploads/products/153260666737784096_657316234648979_2633385684882161664_n.jpg',
            'https://phuongrosa.com/file/entry/2020/04/1586366581-10624.jpg',
            'https://quangcanhxanh.vn/wp-content/uploads/2019/08/TBTX5.jpg',
            'https://media3.scdn.vn/img4/2020/09_26/7xPYESLYHrzn97fGBzPL_simg_de2fe0_500x500_maxb.jpg',
            'https://cf.shopee.vn/file/8a44beaf263d9c3f5ad466b09fea0059',
            'https://bizweb.dktcdn.net/100/275/164/products/img-1830-2.jpg?v=1582343188000',
            'https://cf.shopee.vn/file/105373b44fef067d4f3a14273a6e1de5',
            'https://mohinhliti.com/wp-content/uploads/2019/07/mo-hinh-nam-lun-trang-tri-ngoai-canh-438x400.jpg',
            'https://moitruong.net.vn/wp-content/uploads/2018/02/hm3-e1518231282703.jpg',
        ];

        $quantities = [5, 10, 15, 20, 50, 100, 200];

        for ($i = 0; $i < 100; $i++) {
            $product = [
                'name' => $listProductNames[array_rand($listProductNames)],
                'description' => $listProductDescriptions[array_rand($listProductDescriptions)],
                'thumbnail' => $listThumbnails[array_rand($listThumbnails)],
                'status' => 1,
                'quantity' => $quantities[array_rand($quantities)],
                'is_feature' => 0,
                'category_id' => $categories[array_rand($categories)],
            ];
            $saveProduct = Product::create($product);

            // save product_details
            $productDetail = [
                'content' => $listProductDescriptions[array_rand($listProductDescriptions)],
                'product_id' => $saveProduct->id, // get ID inserted at step above
            ];
            ProductDetail::create($productDetail);

            // save product_images
            for ($j = 0; $j < 10; $j++) {
                $productImage = [
                    'url' => $listImages[array_rand($listImages)],
                    'product_id' => $saveProduct->id,
                ];
                ProductImage::create($productImage);
            }
        }
    }
}
