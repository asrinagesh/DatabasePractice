<?php
for( $i = 0, $z =3; $i <= 22; $i = $i + 3, $z += 2)
{
    echo sprintf('%d%s',$i+$z,PHP_EOL);
    echo sprintf('%d%s',--$i+--$z,PHP_EOL);
}
