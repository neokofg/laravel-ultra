<?php

namespace App\Application\Commands;

readonly abstract class Command
{
    /**
     * @return array
     */
    public function getInfo(): array
    {
        $data = get_object_vars($this);
        return [$data, array_keys($data)];
    }
}
