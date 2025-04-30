<?php

namespace App\Enums;

enum ErrorCode
{
    case UNCATEGORIZED_EXCEPTION;
    case UNAUTHENTICATED;
    case UNAUTHORIZED;
    case TOKEN_EXPIRED;
    case TOKEN_INVALID;
    case INCORRECT_LOGIN_INFO;
    case INCORRECT_RF_TOKEN;

    case USER_EXISTED;
    case EMAIL_EXITED;
    case USER_NON_EXISTED;
    case PASSWORD_NOT_MATCH;
    case USERNAME_NOT_NULL;
    case USERNAME_SIZE;
    case EMAIL_NOT_NULL;
    case EMAIL_NOT_FORMAT;
    case ADDRESS_NOT_NULL;
    case ADDRESS_SIZE;
    case PHONENUMBER_NOT_NULL;
    case PHONENUMBER_NOT_FORMAT;
    case PASSWORD_NOT_NULL;
    case PASSWORD_SIZE;
    case PASSWORD_NOT_FORMAT;

    case FILE_TOO_LARGE;
    case WRONG_FILE_FORMAT;
    case IMAGE_NON_EXISTED;


    case COMMENT_CONTENT_TOO_SHORT;
    case COMMENT_NON_EXISTED;
    case COMMENT_CONTENT_NOT_EMPTY;

    case FIELD_NOT_FOUND;
    case FIELD_NOT_EMPTY;
    case BOOKING_CONFLICT;
    case BOOKING_NOT_FOUND;
    case UNAUTHORIZED_ACTION;


    public function code(): int
    {
        return match($this) {

            self::UNCATEGORIZED_EXCEPTION => 9999,
            self::UNAUTHENTICATED => 1000,
            self::UNAUTHORIZED => 1001,
            self::TOKEN_EXPIRED => 1002,
            self::INCORRECT_LOGIN_INFO => 1003,
            self::INCORRECT_RF_TOKEN => 1004,
            self::TOKEN_INVALID => 1005,

            self::USER_EXISTED => 1010,
            self::EMAIL_EXITED => 1011,
            self::USER_NON_EXISTED => 1012,
            self::FILE_TOO_LARGE => 1015,
            self::WRONG_FILE_FORMAT => 1016,
            self::IMAGE_NON_EXISTED => 1017,
            self::PASSWORD_NOT_MATCH => 1018,
            self::USERNAME_NOT_NULL => 1019,
            self::USERNAME_SIZE => 1020,
            self::EMAIL_NOT_NULL => 1021,
            self::EMAIL_NOT_FORMAT => 1022,
            self::ADDRESS_NOT_NULL => 1023,
            self::ADDRESS_SIZE => 1024,
            self::PHONENUMBER_NOT_NULL => 1025,
            self::PHONENUMBER_NOT_FORMAT => 1026,
            self::PASSWORD_NOT_NULL => 1027,
            self::PASSWORD_SIZE => 1028,
            self::PASSWORD_NOT_FORMAT => 1029,


            self::COMMENT_CONTENT_TOO_SHORT => 2002,
            self::COMMENT_NON_EXISTED => 2003,
            self::COMMENT_CONTENT_NOT_EMPTY => 2004,

            self::FIELD_NOT_EMPTY => 5004,
            self::FIELD_NOT_FOUND => 5000,

            self::BOOKING_CONFLICT => 5001,
            self::BOOKING_NOT_FOUND => 5002,
            self::UNAUTHORIZED_ACTION => 5003,
        };
    }

    public function message(): string
    {
        return match($this) {

            self::UNCATEGORIZED_EXCEPTION => "Lỗi chưa được phân loại",
            self::UNAUTHENTICATED => "Không thể xác thực người dùng",
            self::UNAUTHORIZED => "Bạn không có quyền truy cập",
            self::TOKEN_EXPIRED => "Token đã hết hạn",
            self::INCORRECT_LOGIN_INFO => "Sai thông tin đăng nhập",
            self::INCORRECT_RF_TOKEN => "Refresh token không hợp lệ hoặc hết hạn",
            self::TOKEN_INVALID => "Token không hợp lệ",

            self::USER_EXISTED => "User đã tồn tại",
            self::EMAIL_EXITED => "Email đã tồn tại",
            self::USER_NON_EXISTED => "User không tồn tại",
            self::PASSWORD_NOT_MATCH => "Password và Retype password không trùng nhau",
            self::USERNAME_NOT_NULL => "Username không được để trống",
            self::USERNAME_SIZE => "Độ dài tên lớn hơn 2 và không vượt quá 50 kí tự",
            self::EMAIL_NOT_NULL => "Email không được để trống",
            self::EMAIL_NOT_FORMAT => "Email không đúng định dạng",
            self::ADDRESS_NOT_NULL => "Địa chỉ không được để trống",
            self::ADDRESS_SIZE => "Độ dài địa chỉ lớn hơn 5 và không vượt quá 255 kí tự",
            self::PHONENUMBER_NOT_NULL => "Số điện thoại không được để trống",
            self::PHONENUMBER_NOT_FORMAT => "Số điện thoại không đúng định dạng",
            self::PASSWORD_NOT_NULL => "Password và RetypePassword không được để trống",
            self::PASSWORD_SIZE => "Độ dài password cần chứa ít nhất 8 kí tự",
            self::PASSWORD_NOT_FORMAT => "Password cần chứa chữ thường, chữ hoa, số và kí tự đặc biệt",


            self::FILE_TOO_LARGE => "Kích thước file vượt quá 10MB",
            self::WRONG_FILE_FORMAT => "Sai định dạng file",
            self::IMAGE_NON_EXISTED => "Hình ảnh không tồn tại",

            self::COMMENT_CONTENT_NOT_EMPTY => "Nội dung bình luận không được để trống!",
            self::COMMENT_CONTENT_TOO_SHORT => "Nội dung bình luận không được dưới 15 ký tự",
            self::COMMENT_NON_EXISTED => "Bình luận không tồn tại",

            self::FIELD_NOT_EMPTY => "Sân không được để trống!",
            self::FIELD_NOT_FOUND => "Không tồn tại sân",
            self::BOOKING_CONFLICT => "Sân đã được đặt trong khoảng thời gian này",
            self::BOOKING_NOT_FOUND => "Lịch đặt sân không được tìm thấy",
            self::UNAUTHORIZED_ACTION => "Bạn không có quyền thực hiện hành động này"
        };
    }

    public function httpStatus(): int
    {
        return match($this) {
            self::UNCATEGORIZED_EXCEPTION => 500,
            self::UNAUTHENTICATED,
            self::INCORRECT_RF_TOKEN,
            self::TOKEN_INVALID,
            self::INCORRECT_LOGIN_INFO => 401,

            self::UNAUTHORIZED_ACTION,
            self::UNAUTHORIZED,
            self::TOKEN_EXPIRED => 403,

            self::USER_EXISTED,
            self::EMAIL_EXITED,
            self::USER_NON_EXISTED,
            self::PASSWORD_NOT_MATCH,
            self::USERNAME_NOT_NULL,
            self::USERNAME_SIZE,
            self::EMAIL_NOT_NULL,
            self::EMAIL_NOT_FORMAT,
            self::ADDRESS_NOT_NULL,
            self::ADDRESS_SIZE,
            self::PHONENUMBER_NOT_NULL,
            self::PHONENUMBER_NOT_FORMAT,
            self::PASSWORD_NOT_NULL,
            self::PASSWORD_SIZE,
            self::PASSWORD_NOT_FORMAT,
            self::IMAGE_NON_EXISTED,
            self::FIELD_NOT_FOUND,
            self::FILE_TOO_LARGE,
            self::FIELD_NOT_EMPTY,
            self::WRONG_FILE_FORMAT,
            self::BOOKING_CONFLICT,
            self::BOOKING_NOT_FOUND,
            self::COMMENT_CONTENT_NOT_EMPTY,
            self::COMMENT_CONTENT_TOO_SHORT,
            self::COMMENT_NON_EXISTED => 400,

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
