<?php


namespace App\Resources\Output;

interface OutputMessageInterface {
    const key = '__Message__';
    const Error = 'Error';
    const Danger = 'Danger';
    const Success = 'Success';
}