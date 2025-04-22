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
            self::BOOKING_CONFLICT,
            self::USER_EXISTED,
            self::EMAIL_EXITED,
            self::FIELD_NOT_FOUND,
            self::USER_NON_EXISTED,
            self::ANSWER_NON_EXISTED,
            self::FILE_TOO_LARGE,
            self::FIELD_NOT_EMPTY,
            self::WRONG_FILE_FORMAT,

            self::BOOKING_NOT_FOUND,
            self::BOOKING_START_IN_PAST,
            self::BOOKING_START_TOO_FAR,
            self::IMAGE_NON_EXISTED,
            self::PASSWORD_NOT_MATCH,
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
