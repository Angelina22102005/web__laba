<?php
namespace App\Helpers;

class ClientFactory
{
    public static function make($baseUri)
    {
        return new class($baseUri) {
            private $baseUri;
            
            public function __construct($baseUri) {
                $this->baseUri = $baseUri;
            }
            
            public function get($path) {
                return new class {
                    public function getBody() {
                        return new class {
                            public function getContents() {
                                return "Simple HTTP client - GET request";
                            }
                        };
                    }
                };
            }
        };
    }
}