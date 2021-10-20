<?php

namespace App\Enums;

abstract class ResponseMessage {

    //Auth
    const ERROR_INVALID_PASSWORD_OR_USERNAME = "error_invalid_password_or_username";
    const SUCCESS_LOGOUT                     = "succes_logout";
}