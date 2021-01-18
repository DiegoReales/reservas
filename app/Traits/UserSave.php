<?php

namespace App\Traits;

use Encore\Admin\Facades\Admin;

trait UserSave {

    public function save(array $options = []) {
        $username = Admin::user()->username ?? null;
        if (!$this->id) $this->created_by = $username;
        $this->updated_by = $username;
        return parent::save($options);
    }
}

?>
