<?php
namespace Frmk\Http\Request;

class Request
{
    public array $data = [];

    public function __construct()
    {
        $this->data = $_REQUEST;
    }

    public function get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function all(): array
    {
        return $this->data;
    }

    public function only(array $keys): array
    {
        $filteredData = [];
        foreach ($keys as $key) {
            if (array_key_exists($key, $this->data)) {
                $filteredData[$key] = $this->data[$key];
            }
        }
        return $filteredData;
    }

    public function except(array $keys): array
    {
        $filteredData = $this->data;
        foreach ($keys as $key) {
            unset($filteredData[$key]);
        }
        return $filteredData;
    }

}
