<?php
  # Copyright (c) 2014 Haskell Camargo <haskell@linuxmail.org>
  #
  # Permission is hereby granted, free of charge, to any person
  # obtaining a copy of this software and associated documentation files
  # (the "Software"), to deal in the Software without restriction,
  # including without limitation the rights to use, copy, modify, merge,
  # publish, distribute, sublicense, and/or sell copies of the Software,
  # and to permit persons to whom the Software is furnished to do so,
  # subject to the following conditions:
  #
  # The above copyright notice and this permission notice shall be
  # included in all copies or substantial of portions the Software.
  #
  # THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  # EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  # MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  # NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
  # LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
  # OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
  # WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

  class Apache {
    public static function environment($variable) {
      return apache_getenv($variable);
    }

    public static function note($name) {
      return apache_note($name);
    }

    public static function set_environment($variable, $value) {
      return apache_setenv($variable, $value);
    }

    public static function modules() {
      return apache_get_modules();
    }

    public static function version() {
      return apache_get_version();
    }

    public static function lookup_uri($filename) {
      return apache_lookup_uri($filename);
    }

    public static function request_headers() {
      return apache_request_headers();
    }

    public static function reset_timeout() {
      return apache_reset_timeout();
    }

    public static function response_headers() {
      return apache_response_headers();
    }
  }