
<?php
class Districts {
    public int $code;
    public string $name;
    public int $province_code;

    public function __construct(int $code, string $name, int $province_code) {
        $this->code = $code;
        $this->name = $name;
        $this->province_code = $province_code;
    }
}

?>
