<?php


namespace App\Resources\Output;

interface OutputMessageInterface {
    const key = '__Message__';
    const Error = 'Error';
    const Warning = 'Warning';
    const Success = 'Success';
}