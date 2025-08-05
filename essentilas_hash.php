<?php

$filepath = __DIR__ . '/essentials.php';

if ( ! file_exists( $filepath ) ) {
    exit("❌ essentials.php not found in current directory.\n");
}

$content = file_get_contents( $filepath );

// Extract current version
preg_match('/^\/\/\s*Version:\s*([\d.]+)/mi', $content, $version_match);
$version = $version_match[1] ?? '0.0.0';

// Remove old hash line (if it exists)
$clean_code = preg_replace('/^\/\/\s*Hash:\s*[a-f0-9]{64}\s*\n?/mi', '', $content);

// Generate hash of the cleaned file
$hash = hash('sha256', $clean_code);

// Construct new header
$lines = explode("\n", $clean_code);
$insertion_index = 1;

// Insert hash after version line
foreach ( $lines as $i => $line ) {
    if ( preg_match('/^\/\/\s*Version:/', $line) ) {
        $insertion_index = $i + 1;
        break;
    }
}

array_splice($lines, $insertion_index, 0, '// Hash: ' . $hash);
$final_code = implode("\n", $lines);

// Save back to file
file_put_contents( $filepath, $final_code );