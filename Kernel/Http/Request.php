<?php

namespace App\Kernel\Http;

use App\Kernel\Upload\UploadedFile;
use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;

class Request implements RequestInterface
{
    private ValidatorInterface $validator;


    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $cookie,
        public readonly array $files,
    ) {

    }
    public static function createFromGlobals(): static
    {
        return new static(
            $_GET, $_POST, $_SERVER, $_COOKIE, $_FILES,);
    }

    public function uri(): string
        {
            return strtok($this->server['REQUEST_URI'], '?');
        }

    public function method(): string
    {
            return $this->server['REQUEST_METHOD'];
    }

    public function input( string $key, $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }
    public function file(string $key): ?UploadedFileInterface
    {
        if (! isset($this->files[$key])) {
            return null;
        }
        return new UploadedFile(
            $this->files[$key]['name'],
            $this->files[$key]['type'],
            $this->files[$key]['tmp_name'],
            $this->files[$key]['error'],
            $this->files[$key]['size'],
        );
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function validate(array $rules): bool
    {

        $data = [];

        foreach ($rules as $key => $rule) {
            $data[$key] = $this->input($key);
        }
        return $this->validator->validate($this->post, $rules);
    }

    public function errors():array
    {
        return $this->validator->errors();
    }

}