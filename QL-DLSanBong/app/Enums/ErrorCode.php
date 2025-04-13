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
    case QUESTION_NON_EXISTED;
    case ANSWER_NON_EXISTED;
    case FILE_TOO_LARGE;
    case WRONG_FILE_FORMAT;
    case IMAGE_NON_EXISTED;
    case PASSWORD_NOT_MATCH;

    case QUESTIONANDANSWER_NON_EXISTED;
    case COMMENT_CONTENT_TOO_SHORT;
    case COMMENT_NON_EXISTED;

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
            self::QUESTION_NON_EXISTED => 1013,
            self::ANSWER_NON_EXISTED => 1014,
            self::FILE_TOO_LARGE => 1015,
            self::WRONG_FILE_FORMAT => 1016,
            self::IMAGE_NON_EXISTED => 1017,
            self::PASSWORD_NOT_MATCH => 1018,

            self::QUESTIONANDANSWER_NON_EXISTED => 2001,
            self::COMMENT_CONTENT_TOO_SHORT => 2002,
            self::COMMENT_NON_EXISTED => 2003,
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
            self::QUESTION_NON_EXISTED => "Câu hỏi không tồn tại",
            self::ANSWER_NON_EXISTED => "Câu trả lời không tồn tại",
            self::FILE_TOO_LARGE => "Kích thước file vượt quá 10MB",
            self::WRONG_FILE_FORMAT => "Sai định dạng file",
            self::IMAGE_NON_EXISTED => "Hình ảnh không tồn tại",
            self::PASSWORD_NOT_MATCH => "Password và Retype password không trùng nhau",

            self::QUESTIONANDANSWER_NON_EXISTED => "Câu hỏi hoặc câu trả lời không tồn tại",
            self::COMMENT_CONTENT_TOO_SHORT => "Nội dung bình luận không được dưới 15 ký tự",
            self::COMMENT_NON_EXISTED => "Bình luận không tồn tại",
        };
    }

    public function httpStatus(): int
    {
        return match($this) {
            self::UNCATEGORIZED_EXCEPTION => 500,
            self::UNAUTHENTICATED => 401,
            self::UNAUTHORIZED,
            self::TOKEN_EXPIRED => 403,

            self::USER_EXISTED,
            self::EMAIL_EXITED,
            self::USER_NON_EXISTED,
            self::QUESTION_NON_EXISTED,
            self::ANSWER_NON_EXISTED,
            self::FILE_TOO_LARGE,
            self::WRONG_FILE_FORMAT,
            self::IMAGE_NON_EXISTED,
            self::PASSWORD_NOT_MATCH,
            self::QUESTIONANDANSWER_NON_EXISTED,
            self::COMMENT_CONTENT_TOO_SHORT,
            self::COMMENT_NON_EXISTED => 400,
        };
    }
}
