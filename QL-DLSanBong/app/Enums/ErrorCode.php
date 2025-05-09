<?php

namespace App\Enums;

enum ErrorCode
{
    case UNCATEGORIZED_EXCEPTION;
    case UNAUTHENTICATED;
    case UNAUTHORIZED;
    case TOKEN_EXPIRED;

    case USER_EXISTED;
    case EMAIL_EXITED;
    case USER_NON_EXISTED;
    case ANSWER_NON_EXISTED;
    case FILE_TOO_LARGE;
    case WRONG_FILE_FORMAT;
    case IMAGE_NON_EXISTED;
    case PASSWORD_NOT_MATCH;

    case COMMENT_CONTENT_TOO_SHORT;
    case COMMENT_NON_EXISTED;
    case COMMENT_CONTENT_NOT_EMPTY;

    case FIELD_NOT_FOUND;
    case FIELD_NOT_EMPTY;
    case BOOKING_CONFLICT;
    case BOOKING_NOT_FOUND;
    case BOOKING_START_IN_PAST;
    case BOOKING_START_TOO_FAR;
    case UNAUTHORIZED_ACTION;

    // Validate Field
    case FIELD_NAME_REQUIRED;
    case FIELD_NAME_MUST_BE_STRING;
    case FIELD_NAME_TOO_LONG;

    case FIELD_ADDRESS_REQUIRED;
    case FIELD_ADDRESS_MUST_BE_STRING;
    case FIELD_ADDRESS_TOO_LONG;

    case CATEGORY_ID_REQUIRED;
    case CATEGORY_ID_NOT_FOUND;

    case STATE_ID_REQUIRED;
    case STATE_ID_NOT_FOUND;

    case FIELD_PRICE_REQUIRED;
    case FIELD_PRICE_INVALID;
    case FIELD_PRICE_TOO_LOW;
    case FIELD_PRICE_TOO_HIGH;

    case FIELD_DESCRIPTION_INVALID;
    case FIELD_LATITUDE_INVALID;
    case FIELD_LATITUDE_OUT_OF_RANGE;
    case FIELD_LONGITUDE_INVALID;
    case FIELD_LONGITUDE_OUT_OF_RANGE;

    case FIELD_IMAGE_REQUIRED;
    case FIELD_IMAGE_MUST_BE_ARRAY;
    case FIELD_IMAGE_INVALID;
    case FIELD_IMAGE_INVALID_TYPE;
    case FIELD_IMAGE_TOO_LARGE;
    case FIELD_NOT_ACTIVE;




    public function code(): int
    {
        return match($this) {
            self::UNCATEGORIZED_EXCEPTION => 9999,
            self::UNAUTHENTICATED => 1000,
            self::UNAUTHORIZED => 1001,
            self::TOKEN_EXPIRED => 1002,

            self::USER_EXISTED => 1010,
            self::EMAIL_EXITED => 1011,
            self::USER_NON_EXISTED => 1012,
            self::ANSWER_NON_EXISTED => 1014,
            self::FILE_TOO_LARGE => 1015,
            self::WRONG_FILE_FORMAT => 1016,
            self::IMAGE_NON_EXISTED => 1017,
            self::PASSWORD_NOT_MATCH => 1018,

            self::COMMENT_CONTENT_TOO_SHORT => 2002,
            self::COMMENT_NON_EXISTED => 2003,
            self::COMMENT_CONTENT_NOT_EMPTY => 2004,

            self::FIELD_NOT_EMPTY => 5004,
            self::FIELD_NOT_FOUND => 5000,
            self::BOOKING_CONFLICT => 5001,
            self::BOOKING_NOT_FOUND => 5002,
            self::UNAUTHORIZED_ACTION => 5003,
            self::BOOKING_START_IN_PAST => 5004,
            self::BOOKING_START_TOO_FAR => 5005,


            // Field Validation Codes
            self::FIELD_NAME_REQUIRED => 5100,
            self::FIELD_NAME_MUST_BE_STRING => 5101,
            self::FIELD_NAME_TOO_LONG => 5102,

            self::FIELD_ADDRESS_REQUIRED => 5110,
            self::FIELD_ADDRESS_MUST_BE_STRING => 5111,
            self::FIELD_ADDRESS_TOO_LONG => 5112,

            self::CATEGORY_ID_REQUIRED => 5120,
            self::CATEGORY_ID_NOT_FOUND => 5122,

            self::STATE_ID_REQUIRED => 5130,
            self::STATE_ID_NOT_FOUND => 5132,

            self::FIELD_PRICE_REQUIRED => 5140,
            self::FIELD_PRICE_INVALID => 5141,
            self::FIELD_PRICE_TOO_LOW => 5142,
            self::FIELD_PRICE_TOO_HIGH => 5143,

            self::FIELD_DESCRIPTION_INVALID => 5150,
            self::FIELD_LATITUDE_INVALID => 5160,
            self::FIELD_LATITUDE_OUT_OF_RANGE => 5161,
            self::FIELD_LONGITUDE_INVALID => 5170,
            self::FIELD_LONGITUDE_OUT_OF_RANGE => 5171,

            self::FIELD_IMAGE_REQUIRED => 5180,
            self::FIELD_IMAGE_MUST_BE_ARRAY => 5181,
            self::FIELD_IMAGE_INVALID => 5182,
            self::FIELD_IMAGE_INVALID_TYPE => 5183,
            self::FIELD_IMAGE_TOO_LARGE => 5184,
            self::FIELD_NOT_ACTIVE => 5185,



        };
    }

    public function message(): string
    {
        return match($this) {
            self::UNCATEGORIZED_EXCEPTION => "Lỗi chưa được phân loại",
            self::UNAUTHENTICATED => "Không thể xác thực người dùng",
            self::UNAUTHORIZED => "Bạn không có quyền truy cập",
            self::TOKEN_EXPIRED => "Token đã hết hạn",

            self::USER_EXISTED => "User đã tồn tại",
            self::EMAIL_EXITED => "Email đã tồn tại",
            self::USER_NON_EXISTED => "User không tồn tại",
            self::ANSWER_NON_EXISTED => "Câu trả lời không tồn tại",
            self::FILE_TOO_LARGE => "Kích thước file vượt quá 10MB",
            self::WRONG_FILE_FORMAT => "Sai định dạng file",
            self::IMAGE_NON_EXISTED => "Hình ảnh không tồn tại",
            self::PASSWORD_NOT_MATCH => "Password và Retype password không trùng nhau",

            self::COMMENT_CONTENT_NOT_EMPTY => "Nội dung bình luận không được để trống!",
            self::COMMENT_CONTENT_TOO_SHORT => "Nội dung bình luận không được dưới 15 ký tự",
            self::COMMENT_NON_EXISTED => "Bình luận không tồn tại",

            self::FIELD_NOT_EMPTY => "Sân không được để trống!",
            self::FIELD_NOT_FOUND => "Không tồn tại sân",
            self::BOOKING_CONFLICT => "Sân đã được đặt trong khoảng thời gian này",
            self::BOOKING_NOT_FOUND => "Lịch đặt sân không được tìm thấy",
            self::UNAUTHORIZED_ACTION => "Bạn không có quyền thực hiện hành động này",
            self::BOOKING_START_IN_PAST => "Không thể đặt sân trong quá khứ",
            self::BOOKING_START_TOO_FAR => "Chỉ được đặt sân tối đa trước 30 ngày",

            // New FIELD Validation Messages
            self::FIELD_NAME_REQUIRED => 'Tên sân không được để trống',
            self::FIELD_NAME_MUST_BE_STRING => 'Tên sân phải là chuỗi',
            self::FIELD_NAME_TOO_LONG => 'Tên sân quá dài',

            self::FIELD_ADDRESS_REQUIRED => 'Địa chỉ không được để trống',
            self::FIELD_ADDRESS_MUST_BE_STRING => 'Địa chỉ phải là chuỗi',
            self::FIELD_ADDRESS_TOO_LONG => 'Địa chỉ quá dài',

            self::CATEGORY_ID_REQUIRED => 'Danh mục không được để trống',
            self::CATEGORY_ID_NOT_FOUND => 'Không tìm thấy danh mục',

            self::STATE_ID_REQUIRED => 'Trạng thái không được để trống',
            self::STATE_ID_NOT_FOUND => 'Không tìm thấy trạng thái',

            self::FIELD_PRICE_REQUIRED => 'Giá sân không được để trống',
            self::FIELD_PRICE_INVALID => 'Giá sân không hợp lệ',
            self::FIELD_PRICE_TOO_LOW => 'Giá sân không thể nhỏ hơn 0',
            self::FIELD_PRICE_TOO_HIGH => 'Giá sân vượt quá mức cho phép',

            self::FIELD_DESCRIPTION_INVALID => 'Mô tả không hợp lệ',
            self::FIELD_LATITUDE_INVALID => 'Latitude không hợp lệ',
            self::FIELD_LATITUDE_OUT_OF_RANGE => 'Latitude phải nằm trong khoảng -90 đến 90',
            self::FIELD_LONGITUDE_INVALID => 'Longitude không hợp lệ',
            self::FIELD_LONGITUDE_OUT_OF_RANGE => 'Longitude phải nằm trong khoảng -180 đến 180',

            self::FIELD_IMAGE_REQUIRED => 'Ảnh không được để trống',
            self::FIELD_IMAGE_MUST_BE_ARRAY => 'Ảnh phải là mảng',
            self::FIELD_IMAGE_INVALID => 'Tệp phải là hình ảnh',
            self::FIELD_IMAGE_INVALID_TYPE => 'Loại ảnh không được hỗ trợ',
            self::FIELD_IMAGE_TOO_LARGE => 'Ảnh vượt quá dung lượng cho phép (2MB)',
            self::FIELD_NOT_ACTIVE => 'Sân hiện không hoạt động, không thể đặt chỗ',

        };
    }

    public function httpStatus(): int
    {
        return match($this) {
            self::UNCATEGORIZED_EXCEPTION => 500,
            self::UNAUTHENTICATED => 401,
            self::UNAUTHORIZED_ACTION,
            self::UNAUTHORIZED,
            self::TOKEN_EXPIRED => 403,

            self::USER_EXISTED,
            self::EMAIL_EXITED,
            self::USER_NON_EXISTED,
            self::ANSWER_NON_EXISTED,
            self::FILE_TOO_LARGE,
            self::WRONG_FILE_FORMAT,
            self::IMAGE_NON_EXISTED,
            self::PASSWORD_NOT_MATCH,

            self::COMMENT_CONTENT_NOT_EMPTY,
            self::COMMENT_CONTENT_TOO_SHORT,
            self::COMMENT_NON_EXISTED,

            self::FIELD_NOT_EMPTY,
            self::FIELD_NOT_FOUND,
            self::BOOKING_CONFLICT,
            self::BOOKING_NOT_FOUND,
            self::BOOKING_START_IN_PAST,
            self::BOOKING_START_TOO_FAR,

                // New Field Validation
            self::FIELD_NAME_REQUIRED,
            self::FIELD_NAME_MUST_BE_STRING,
            self::FIELD_NAME_TOO_LONG,

            self::FIELD_ADDRESS_REQUIRED,
            self::FIELD_ADDRESS_MUST_BE_STRING,
            self::FIELD_ADDRESS_TOO_LONG,

            self::CATEGORY_ID_REQUIRED,
            self::CATEGORY_ID_NOT_FOUND,

            self::STATE_ID_REQUIRED,
            self::STATE_ID_NOT_FOUND,

            self::FIELD_PRICE_REQUIRED,
            self::FIELD_PRICE_INVALID,
            self::FIELD_PRICE_TOO_LOW,
            self::FIELD_PRICE_TOO_HIGH,
            self::FIELD_NOT_ACTIVE,

            self::FIELD_DESCRIPTION_INVALID,
            self::FIELD_LATITUDE_INVALID,
            self::FIELD_LATITUDE_OUT_OF_RANGE,
            self::FIELD_LONGITUDE_INVALID,
            self::FIELD_LONGITUDE_OUT_OF_RANGE,

            self::FIELD_IMAGE_REQUIRED,
            self::FIELD_IMAGE_MUST_BE_ARRAY,
            self::FIELD_IMAGE_INVALID,
            self::FIELD_IMAGE_INVALID_TYPE,
            self::FIELD_IMAGE_TOO_LARGE => 400,

        };
    }

    public static function getCaseName(string $value)
    {
        foreach (self::cases() as $case) {
            if ($case->name === $value) {
                return $case;
            }
        }
        return self::UNCATEGORIZED_EXCEPTION; // Không tìm thấy case
    }
}
