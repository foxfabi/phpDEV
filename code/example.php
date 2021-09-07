<?php
/**
 * Zusatzaufgabe 1 - Beispiel
 *
 * @author Christof Raidler <christof.raidler@zli.ch>
 */

/**
 * Find prime numbers by counting their integer divisors (prime numbers only have two integer divisors)
 *
 * @param int $number
 * @return bool
 */
function isPrime($number)
{
    $divisors = 0;

    for ($i = 1; $i <= $number; $i++) {
        if (0 == $number % $i) {
            $divisors++;
        }
    }

    return 2 == $divisors;
}

/**
 * Grab limit from user and limit to 10000
 */
$found = 0;
$limit = readline('Limit: ');

if (10000 < $limit) {
    $limit = 10000;
}

print PHP_EOL;

/**
 * Main loop
 */
for ($i = 1; $i <= $limit; $i++) {
    if (isPrime($i)) {
        print $i . ' ';
        $found++;
    }
}

printf('%1$s %1$sEs wurden %2$d Primzahlen gefunden!', PHP_EOL, $found);
