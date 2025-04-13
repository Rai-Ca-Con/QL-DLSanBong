<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fields')->insert([
            [
                'id' => 'uuid-0001-aaaa-bbbb-000000000001',
                'name' => 'Sân A',
                'address' => '123 Trần Hưng Đạo, Hà Nội',
                'category_id' => 'cat-uuid-001',
                'state_id' => 'state-001',
                'price' => 500000,
                'description' => 'Sân tiêu chuẩn 7 người',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 'uuid-0002-aaaa-bbbb-000000000002',
                'name' => 'Sân B',
                'address' => '456 Nguyễn Huệ, TP.HCM',
                'category_id' => 'cat-uuid-002',
                'state_id' => 'state-002',
                'price' => 700000,
                'description' => 'Có hệ thống chiếu sáng tốt',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 'uuid-0003-aaaa-bbbb-000000000003',
                'name' => 'Sân C',
                'address' => '789 Lê Lợi, Đà Nẵng',
                'category_id' => 'cat-uuid-001',
                'state_id' => 'state-001',
                'price' => 600000,
                'description' => 'Vị trí trung tâm, dễ tìm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => '2024-12-01 10:00:00',
            ],
            [
                'id' => 'uuid-0004-aaaa-bbbb-000000000004',
                'name' => 'Sân D',
                'address' => '321 Hai Bà Trưng, Cần Thơ',
                'category_id' => 'cat-uuid-003',
                'state_id' => 'state-003',
                'price' => 450000,
                'description' => 'Có mái che, chỗ để xe rộng',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 'uuid-0005-aaaa-bbbb-000000000005',
                'name' => 'Sân E',
                'address' => '654 Phan Chu Trinh, Huế',
                'category_id' => 'cat-uuid-002',
                'state_id' => 'state-002',
                'price' => 550000,
                'description' => 'Cải tạo gần đây, chất lượng tốt',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 'uuid-0006-aaaa-bbbb-000000000006',
                'name' => 'Sân F',
                'address' => '111 Trường Chinh, Hà Nội',
                'category_id' => 'cat-uuid-001',
                'state_id' => 'state-001',
                'price' => 650000,
                'description' => 'Mặt cỏ mới, thoát nước nhanh',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => '2025-01-15 15:30:00',
            ],
            [
                'id' => 'uuid-0007-aaaa-bbbb-000000000007',
                'name' => 'Sân G',
                'address' => '222 Lý Thường Kiệt, TP.HCM',
                'category_id' => 'cat-uuid-003',
                'state_id' => 'state-002',
                'price' => 480000,
                'description' => 'Sân nhỏ phù hợp đá 5 người',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 'uuid-0008-aaaa-bbbb-000000000008',
                'name' => 'Sân H',
                'address' => '333 Điện Biên Phủ, Đà Lạt',
                'category_id' => 'cat-uuid-001',
                'state_id' => 'state-001',
                'price' => 520000,
                'description' => 'Không khí mát mẻ, dễ chịu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 'uuid-0009-aaaa-bbbb-000000000009',
                'name' => 'Sân I',
                'address' => '444 Nguyễn Văn Cừ, Hải Phòng',
                'category_id' => 'cat-uuid-002',
                'state_id' => 'state-002',
                'price' => 580000,
                'description' => 'Trang bị mới, sạch sẽ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => '2025-03-10 09:45:00',
            ],
            [
                'id' => 'uuid-0010-aaaa-bbbb-000000000010',
                'name' => 'Sân J',
                'address' => '555 CMT8, Biên Hòa',
                'category_id' => 'cat-uuid-003',
                'state_id' => 'state-003',
                'price' => 500000,
                'description' => 'Giá rẻ, phù hợp tổ chức giải phong trào',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
