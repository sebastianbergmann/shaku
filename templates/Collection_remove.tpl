

    public function remove({{class}} $item): bool
    {
        foreach ($this->items as $key => $_item) {
            if ($_item === $item) {
                unset($this->items[$key]);

                return true;
            }
        }

        return false;
    }