<?php

use function Livewire\Volt\{state};
use App\Models\Profile;

state(['profile' => fn() => Profile::first()]);

?>
