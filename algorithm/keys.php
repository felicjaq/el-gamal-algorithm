<?php

function get_p_value($min, $max) : int {
    $flag = false; $p = 1;
    while (!$flag) {
        $p = random_int($min, $max);
        $flag = check_for_prime_p_value($p);
    }
    return $p;
}

function check_for_prime_p_value($p) : bool {
    if ($p == 1) return false;
    for ($i = 2; $i <= sqrt($p); $i++)
        if ($p % $i == 0) return false;

    return true;
}

function find_prime_factors($s, $n) : array {
    while ($n % 2 == 0) {
        $s[] = 2;
        $n = $n / 2;
    }

    for ($i = 3; $i <= sqrt($n); $i = $i + 2) {
        while ($n % $i == 0) {
            $s[] = $i;
            $n = $n / $i;
        }
    }

    if ($n > 2) $s[] = $n;

    return $s;
}

function get_g_value($p) : int {
    $phi = $p - 1; $s = []; $s = (find_prime_factors($s, $phi));
    $r = 2;
    while ($r <= $phi)
        foreach ($s as $it)
            if (bcpowmod($r, $phi / $it, $p) != 1)
                return $r;

    return $r;
}

function get_x_value($p) : int {
    return random_int(1, $p - 1);
}

function get_k_value($p) : int {
    $flag = false; $k = 1;
    while (!$flag) {
        $k = random_int(1, $p);
        if(euclid_gcd($k, $p - 1) == 1) $flag = true;
    }
    return $k;
}

function euclid_gcd($k, $p) : int {
    if ($k == 0) return $p;
    return euclid_gcd($p % $k, $k);
}

function keys_generation() : array {
    $p = get_p_value(MIN, MAX);
    $g = get_g_value($p);
    $x = get_x_value($p);
    $y = bcpowmod($g, $x, $p);
    return [$p, $g, $x, $y];
}

